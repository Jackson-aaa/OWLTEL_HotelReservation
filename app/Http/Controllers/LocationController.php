<?php

namespace App\Http\Controllers;

use App\Models\Location;

use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function index()
    {
        $locations = Location::paginate(5);
        return view('admin.location', compact('locations'));
    }

    public $selectedLocation;
    public function store(Request $request)
    {

        \Log::info($request->all());
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'location_id' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'image_link' => 'required|url'
        ]);

        try {
            Location::create($request->all());

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
            'image_link' => 'required|url'
        ]);

        try {
            $location = Location::findOrFail($id);
            $location->update($request->all());

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
            $location = Location::findOrFail($id);
            $location->delete();

            return redirect()->route('locations.index')->with('success', 'Location deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting location: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not delete location.']);
        }
    }


    public function search(Request $request)
    {
        
    }
}
