<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HotelListController extends Controller
{
    public function showListHotel(Request $request)
    {
        $checkIn = Carbon::createFromFormat('d-m-Y', $request->check_in)->format('Y-m-d');
        $checkOut = Carbon::createFromFormat('d-m-Y', $request->check_out)->format('Y-m-d');

        $query = Hotel::with(['location', 'facilities', 'bookings'])
            ->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search_input . '%')
                    ->orWhere('address', 'like', '%' . $request->search_input . '%')
                    ->orWhereHas('location', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search_input . '%')
                        ->orWhereHas('location', function ($nested) use ($request) {
                            $nested->where('name', 'like', '%' . $request->search_input . '%')
                                ->orWhereHas('location', function ($deeper) use ($request) {
                                    $deeper->where('name', 'like', '%' . $request->search_input . '%')
                                        ->orWhereHas('location', function ($deepest) use ($request) {
                                            $deepest->where('name', 'like', '%' . $request->search_input . '%');
                                        });
                                });
                        });
                });
            })
            ->whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
                $q->where(function ($query) use ($checkIn, $checkOut) {
                    $query->where('check_in', '<=', $checkOut)
                        ->where('check_out', '>=', $checkIn);
                });
            });


        $hotels = $query->paginate(5);

        $hotels->transform(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'address' => $item->address,
                'price' => $item->initial_price,
                'image' => json_decode($item->image_link, true)[0],
                'facilities' => $item->facilities->pluck('icon_link')
            ];
        });

        return view('guest.hotel-pick', compact('hotels'));
    }
}