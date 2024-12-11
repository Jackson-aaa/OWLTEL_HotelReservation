<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    public function getBooking(){
        return $this->hasMany(Booking::class, 'hotel_id', 'id');
    }

    public function getLocation(){
        return $this->hasOne(Booking::class, 'location_id', 'id');
    }
}
