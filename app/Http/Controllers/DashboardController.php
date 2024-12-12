<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard(){
        $destinations = Location::all();

        return view('guest.dashboard', compact('destinations'));
    }
}
