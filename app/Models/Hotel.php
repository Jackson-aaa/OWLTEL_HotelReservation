<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

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
}
