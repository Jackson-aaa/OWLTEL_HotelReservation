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

    
    public function bookHotel(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|numeric',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ]);

        return view('guest.booking', ['hideNavbarandFooter' => true])
            ->with('hotel_id', $request->hotel_id)
            ->with('check_in', $request->check_in)
            ->with('check_out', $request->check_out);
    }
}
