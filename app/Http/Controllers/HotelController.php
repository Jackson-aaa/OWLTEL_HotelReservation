<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\Facility;
use App\Models\HotelFacility;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::with('location');

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        $hotels = $query->orderBy('name', 'asc')
            ->orderBy('id', 'asc')
            ->paginate(5);

        $locations = Location::get();

        $hotels->getCollection()->transform(function ($item) use ($locations) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'address' => $item->address,
                'initial_price' => $item->initial_price,
                'image_link' => $item->image_link,
                'locations' => $locations
            ];
        });
        return view('admin.hotel', compact('hotels', 'locations'));
    }

    public function store(Request $request)
    {

        \Log::info($request->all());

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'address' => 'required|string',
                'location_id' => 'required|string|max:255',
                'initial_price' => 'required|numeric',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480'
            ]);

            $image = $request->file('image');
            $imageName = $request->name . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = Storage::disk('azure')->putFileAs('img/hotels', $image, $imageName);
            $request['image_link'] = Storage::disk('azure')->url($imagePath);

            Hotel::create([
                'name' => $request['name'],
                'description' => $request['description'],
                'address' => $request['address'],
                'location_id' => $request['location_id'],
                'initial_price' => $request['initial_price'],
                'image_link' => $request['image_link']
            ]);

            return redirect()->route('hotels.index')->with('success', 'Hotel added successfully!');
        } catch (\Exception $e) {
            \Log::error('Error creating hotel: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not add hotel.']);
        }
    }

    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);

        // return view('admin.edit-location', compact('location'));
        return response()->json($hotel);
    }

    public function update(Request $request, $id)
    {
        \Log::info($request->all());
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'address' => 'required|string',
                'location_id' => 'required|string|max:255',
                'initial_price' => 'required|numeric',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $request->name . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = Storage::disk('azure')->putFileAs('img/hotels', $image, $imageName);
                $request['image_link'] = Storage::disk('azure')->url($imagePath);
            }

            $hotel = Hotel::findOrFail($id);
            $hotel->update($request->all());

            // Capture the 'page' parameter from the request and redirect back with it
            $page = $request->input('page', 1); // Default to 1 if no page is specified

            return redirect()
                ->route('hotels.index', ['page' => $page])
                ->with('success', 'Hotel updated successfully!');
            // return response()->json($hotel);
        } catch (\Exception $e) {
            \Log::error('Error updating hotel: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Could not update hotel.']);
            // return "bro";
        }
    }

    public function destroy($id)
    {
        try {
            $hotel = Hotel::findOrFail($id);
            $hotel->delete();

            return redirect()->route('hotels.index')->with('success', 'Hotel deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting hotel: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not delete hotel.']);
        }
    }

    public function showHotelDescription(Request $request)
    {
        $hotel = Hotel::with('hotelFacilities.facility')->find($request->id);
        // dd(json_decode($hotel->image_link));
        return view("guest.hotel-description")
            ->with("hotel", $hotel);
    }
}
