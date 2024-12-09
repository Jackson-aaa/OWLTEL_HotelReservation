<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::query();

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        $hotels = $query->paginate(5);
        return view('admin.hotel', compact('hotels'));
    }

    public $selectedLocation;
    public function store(Request $request)
    {

        \Log::info($request->all());

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'address' => 'required|string',
                'location_id' => 'nullable|string|max:255',
                'initial_price' => 'required|decimal',

                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480'
            ]);

            $image = $request->file('image');
            $imageName = $request->name . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('img/locations', $imageName);

            Location::create([
                'name' => $request['name'],
                'description' => $request['location_id'],
                'address' => $request['type'],
                'initial_price' => $request['description'],
                'image_link' => asset('storage') . '/' . $imagePath
            ]);

            return redirect()->route('locations.index')->with('success', 'Location added successfully!');
        } catch (\Exception $e) {
            \Log::error('Error creating location: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not add location.']);
        }
    }

    public function edit($id)
    {
        $location = Hotel::findOrFail($id);

        // return view('admin.edit-location', compact('location'));
        return response()->json($location);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location_id' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $request->name . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('img/locations', $imageName);
            $request['image_link'] = asset('storage') . '/' . $imagePath;
        }

        try {
            $hotel = Hotel::findOrFail($id);
            $hotel->update($request->all());

            // Capture the 'page' parameter from the request and redirect back with it
            $page = $request->input('page', 1); // Default to 1 if no page is specified

            return redirect()
                ->route('locations.index', ['page' => $page])
                ->with('success', 'Location updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating location: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Could not update location.']);
        }
    }



    public function destroy($id)
    {
        try {
            $hotel = Hotel::findOrFail($id);
            $hotel->delete();

            return redirect()->route('hotels.index')->with('success', 'Location deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting location: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not delete location.']);
        }
    }
}
