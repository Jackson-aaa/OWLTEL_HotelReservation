<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelFacility extends Model
{
    use HasFactory;

    protected $table = 'hotel_facilities';
    protected $fillable = [
        'hotel_id',
        'facility_id',
    ];

    public $timestamps = true;
}
