<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Hotel;

class BookingController extends Controller
{
    public function showBookingHistory(){
        $bookings = Booking::with('hotel')->get();
        return view('guest.booking-history')
            ->with('bookings', $bookings);
    }
}
