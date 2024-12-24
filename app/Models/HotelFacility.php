<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelFacility extends Model
{
    public function facility()
    {
        return $this->belongsTo(Facility::class, 'facility_id', 'id');
    }
}
