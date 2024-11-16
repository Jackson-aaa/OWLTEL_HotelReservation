<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class CustomerController extends Controller
{
    public function showDashboard(Request $request)
    {

        $search = $request->input('search_input');
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        //Validate checkin and checkout date

        return view('customer.dashboard');
    }

}
