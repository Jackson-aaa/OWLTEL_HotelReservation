<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    
    protected $table = 'locations';
    protected $fillable = [
       'name', 'location_id', 'type', 'description', 'image_link' ];
    
    public $timestamps = true;
}
