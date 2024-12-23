<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HotelFacility;

class Facility extends Model
{
    use HasFactory;

    protected $table = 'facilities';
    protected $fillable = [
        'name',
        'icon_link'
    ];

    public $timestamps = true;

    public function facilities(){
        return $this->belongsToMany(HotelFacility::class, 'hotel_facilities', 'hotel_id', 'facility_id');
    }
}
