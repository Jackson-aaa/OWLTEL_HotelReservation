<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        $query = Facility::query();

        if($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%');
        }

        $facilities = $query->paginate(5);
        return view('admin.facility', compact('facilities'));
    }

    public function store(Request $request)
    {

        \Log::info($request->all());

        try {
            $request->validate(rules: [
                'name' => 'required|string|max:255',
                'icon_link' => 'required|string|max:255'
            ]);

            Facility::create([
                'name' => $request['name'],
                'icon_link' => $request['icon_link'],
            ]);

            return redirect()->route('facilities.index')->with('success', 'Facility added successfully!');
        } catch (\Exception $e) {
            \Log::error('Error creating facility: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not add facility.']);
        }
    }

    public function edit($id)
    {
        $facility = Facility::findOrFail($id);

        return response()->json($facility);
    }

    public function update(Request $request, $id)
    {
        $request->validate(rules: [
            'name' => 'required|string|max:255',
            'icon_link' => 'required|string|max:255'
        ]);

        try {
            $facility = Facility::findOrFail($id);
            $facility->update($request->all());

            // Capture the 'page' parameter from the request and redirect back with it
            $page = $request->input('page', 1); // Default to 1 if no page is specified

            return redirect()
                ->route('facilities.index', ['page' => $page])
                ->with('success', 'Facility updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Error updating facility: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Could not update facility.']);
        }
    }

    public function destroy($id)
    {
        try {
            $facility = Facility::findOrFail($id);
            $facility->delete();

            return redirect()->route('facilities.index')->with('success', 'Facility deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting facility: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not delete facility.']);
        }
    }
}
