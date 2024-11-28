<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public function getHotel(){
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }
}
