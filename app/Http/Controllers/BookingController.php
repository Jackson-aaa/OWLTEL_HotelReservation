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
        $hotel = Hotel::find($request->hotel_id);
        return view('guest.booking', ['hideNavbarandFooter' => true])
            ->with('hotel', $hotel)
            ->with('check_in', $request->check_in)
            ->with('check_out', $request->check_out);
    }

    public function processBooking(Request $request){
        $request->validate([
            'hotel_id' => 'required|numeric',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'phone_number' => 'required|numeric',
            'payment_method' => 'required',
            'card_number' => 'required|numeric',
            'card_month' => 'required|numeric',
            'card_year' => 'required|numeric',
            'card_cvv' => 'required|numeric',
            'card_first_name' => 'required|min:3',
            'card_first_name ' => 'required|min:3'
        ]);
    }
}
