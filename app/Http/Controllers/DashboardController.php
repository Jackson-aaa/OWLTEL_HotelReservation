<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard(){
        $destinations = Location::take(6)->get();

        return view('guest.dashboard', compact('destinations'));
    }
}
