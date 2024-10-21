<?php

namespace App\Http\Controllers;
use App\Models\Location;

use Illuminate\Http\Request;

class LocationController extends Controller
{
   public function index()
   {
       $locations = Location::paginate(10);
       return view('admin.location', compact('locations'));
   }

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


}
