<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelListController extends Controller
{
    public function showListHotel(Request $request){
        if(!$request->has('destination')){
            // what should i write over here? just pick random?
        }
        $locationId = Location::where('name', $request->destination)->first();
        $hotels = $locationId->hotels()->with('facilities')->get();
        return view('guest.hotel-pick', compact('hotels'));
    }
}