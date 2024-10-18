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
}
