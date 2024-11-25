<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $locationTypes = ['Country', 'City', 'Province']
        for($i=0; $i<5; $i++){
            DB::table('locations')->insert([
                'name' => fake()->city(),
                'location_id' => 1,
                'type' => 'City',
                'description' => fake()->text(200),
                'image_link' => fake()->imageUrl(800, 800, 'city', true, 'Location'),
            ]);
        }
    }
}
