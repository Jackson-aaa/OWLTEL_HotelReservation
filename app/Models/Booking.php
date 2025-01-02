<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'hotel_id',
        'check_in',
        'check_out',
        'total_price',
        'booking_for',
        'booking_date',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function review(){
        return $this->hasOne(Review::class);
    }

    public function bookingPayment(){
        return $this->hasOne(BookingPayment::class);
    }

    public $timestamps = true;
}
