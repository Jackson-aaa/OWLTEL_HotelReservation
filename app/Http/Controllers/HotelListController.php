<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelListController extends Controller
{
    public function showListHotel(Request $request){
        if(!$request->has('destination')){
            // what should i write over here? just pick most popular?
        }
        $locationId = Location::where('name', $request->destination)->first();
        $hotels = $locationId->hotels;
        return view('guest.hotel-pick', compact('hotels'));
    }
}