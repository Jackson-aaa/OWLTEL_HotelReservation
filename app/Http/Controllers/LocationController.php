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
            // Create a new location
            Location::create($request->all());
    
            // Redirect with success message
            return redirect()->route('locations.index')->with('success', 'Location added successfully!');
        } catch (\Exception $e) {
            // Log the error message
            \Log::error('Error creating location: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not add location.']);
        }
    }

    public function edit($id)
    {
        $location = Location::findOrFail($id);

        return view('admin.edit-location', compact('location'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'location_id' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'image_link' => 'required|url'
        ]);

        try {
            // Find the location by ID and update it
            $location = Location::findOrFail($id);
            $location->update($request->all());

            // Redirect with success message
            return redirect()->route('locations.index')->with('success', 'Location updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating location: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not update location.']);
        }
    }

    public function destroy($id)
    {
        try {
            // Find the location by its ID and delete it
            $location = Location::findOrFail($id);
            $location->delete();

            // Redirect with success message
            return redirect()->route('locations.index')->with('success', 'Location deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting location: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not delete location.']);
        }
    }
}
