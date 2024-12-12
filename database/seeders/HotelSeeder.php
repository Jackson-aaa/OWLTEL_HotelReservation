<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class HotelSeeder extends Seeder
{
    public function run(): void
    {
        for($i=0; $i<5; $i++){
            DB::table('hotels')->insert([
                'name' => 'Hotel '.$i+1,
                'description' => 'Daun Lebar Villas reconnects you with nature through a unique stay in the heart of Ubud\'s countryside. This 4-star resort offers spacious villas with a distinctive Balinese atmosphere and outdoor swimming pools. Free WiFi is available throughout the resort during your stay',
                'address' => fake()->address(),
                'location_id' => 1,
                'initial_price' => fake()->numberBetween(550000, 35000000)
            ]);
        }
    }
}
