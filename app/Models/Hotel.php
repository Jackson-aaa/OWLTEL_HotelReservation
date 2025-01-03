<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\Facility;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';
    protected $fillable = [
        'name',
        'description',
        'address',
        'description',
        'location_id',
        'initial_price',
        'image_link'
    ];

    public $timestamps = true;

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function hotelFacilities()
    {
        return $this->hasMany(HotelFacility::class, 'hotel_id', 'id');
    }
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'hotel_facilities', 'hotel_id', 'facility_id');
    }
}
