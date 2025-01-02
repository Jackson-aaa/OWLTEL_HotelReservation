<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'booking_id',
        'description',
        'score',
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public $timestamps = true;
}
