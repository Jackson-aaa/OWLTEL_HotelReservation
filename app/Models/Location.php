<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    
    // Specify the table name if it's not the plural of the model name
   protected $table = 'locations';

   // Fillable fields for mass assignment
   protected $fillable = [
       'name', 'location_id', 'type', 'description', 'image_link'
   ];

   // Laravel automatically manages the created_at and updated_at fields
   public $timestamps = true;
}
