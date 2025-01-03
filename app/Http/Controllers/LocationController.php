<?php

namespace App\Http\Controllers;

use App\Models\Location;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{

    public function index(Request $request)
    {
        $query = Location::with('locations');


        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        $locations = $query->orderBy('id', 'asc')
            ->paginate(5);

        $locations_all = Location::all();

        $locations->getCollection()->transform(function ($item) use ($locations_all) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'location_id' => $item->location_id,
                'type' => $item->type,
                'description' => $item->description,
                'image_link' => $item->image_link,
                'locations' => $locations_all,
                'can_delete' => $item->locations()->exists() ? 0 : 1
            ];
        });
        return view('admin.location', compact('locations', 'locations_all'));
    }

    public $selectedLocation;
    public function store(Request $request)
    {

        \Log::info($request->all());

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'location_id' => 'nullable|string|max:255',
                'type' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480'
            ]);

            $image = $request->file('image');
            $imageName = $request->name . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = Storage::disk('azure')->putFileAs('img/locations', $image, $imageName);
            $request['image_link'] = Storage::disk('azure')->url($imagePath);

            Location::create([
                'name' => $request['name'],
                'location_id' => $request['location_id'],
                'type' => $request['type'],
                'description' => $request['description'],
                'image_link' => $request['image_link']
            ]);

            return redirect()->route('locations.index')->with('success', 'Location added successfully!');
        } catch (\Exception $e) {
            \Log::error('Error creating location: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not add location.']);
        }
    }

    public function edit($id)
    {
        $location = Location::findOrFail($id);

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

            // Store the file in Azure Blob Storage
            $imagePath = Storage::disk('azure')->putFileAs('img/locations', $image, $imageName);

            // Generate the full URL to the stored image
            $request['image_link'] = Storage::disk('azure')->url($imagePath);
        }

        try {
            $location = Location::findOrFail($id);
            $location->update($request->all());

            // Capture the 'page' parameter from the request and redirect back with it
            $page = $request->input('page', 1); // Default to 1 if no page is specified

            return redirect()
                ->route('locations.index', ['page' => $page])
                ->with('success', 'Location updated successfully!');
            // return response()->json($location);
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
            $location = Location::findOrFail($id);
            $location->delete();

            return redirect()->route('locations.index')->with('success', 'Location deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting location: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not delete location.']);
        }
    }
}
