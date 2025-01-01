<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Hotel;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function showBookingHistory(){
        $bookings = Booking::with('hotel')
            ->where('user_id', auth()->user()->id)
            ->orderBy('booking_date', 'desc')
            ->paginate(5);

        $bookings->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'hotel_name' => $item->hotel->name,
                'hotel_image' => $item->hotel->image_link,
                'hotel_address' => $item->hotel->address,
                'check_in' => Carbon::parse($item->check_in)->format('d/m/Y'),
                'check_out' => Carbon::parse($item->check_out)->format('d/m/Y'),
                'book_date' => Carbon::parse($item->booking_date)->format('d/m/Y'),
                'booked_for' => $item->booking_for,
                'total_price' => $item->total_price,
                'status' => $item->status
            ];
        });

        return view('guest.booking-history', compact('bookings'));
    }


    public function bookHotel(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|numeric',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ]);

        $hotel = Hotel::find($request->hotel_id);
        $payments = PaymentDetail::where('payment_id', 1)->get();

        return view('guest.booking', ['hideNavbarandFooter' => true])
            ->with('hotel', $hotel)
            ->with('payments', $payments)
            ->with('check_in', $request->check_in)
            ->with('check_out', $request->check_out);
    }

    public function processBooking(Request $request){

        $request->validate([
            'hotel_id' => 'required|numeric',
            'payment_method' => 'required',
            'card_number' => 'required|numeric',
            'card_month' => 'required|digits:2',
            'card_year' => 'required|digits:2',
            'card_cvv' => 'required|digits:3',
            'card_name' => 'required|min:3',
            'check_in' => 'required',
            'check_out' => 'required',
        ]);

        try {
            $checkIn = Carbon::createFromFormat('Y-m-d', $request['check_in']);
            $checkOut = Carbon::createFromFormat('Y-m-d', $request['check_out']);

            $days = $checkIn->diffInDays($checkOut);

            $isBooked = Booking::where('hotel_id', $request['id'])
                ->where(function ($query) use ($checkIn, $checkOut) {
                    $query->where('check_in', '<=', $checkOut)
                        ->where('check_out', '>=', $checkIn);
                });

            if ($isBooked->count() > 0) {
                return back()->withErrors(['error' => 'Hotel is already booked for the selected dates.']);
            }

            $hotel = Hotel::find($request['hotel_id']);
            $price = $hotel->initial_price * $days;

            Booking::create([
                'hotel_id' => $request['hotel_id'],
                'check_in' => $request['check_in'],
                'check_out' => $request['check_out'],
                'total_price' => $price,
                'user_id' => auth()->user()->id,
                'booking_for' => auth()->user()->name,
                'booking_date' => Carbon::now(),
                'status' => 'Booked'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error creating booking: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Could not create booking.']);
        }

        return redirect()->intended('/booking-history');
    }
}
