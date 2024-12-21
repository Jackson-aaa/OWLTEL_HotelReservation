<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 5; $i++) {
            $type = $faker->randomElement(['country', 'region', 'city', 'place']);

            switch ($type) {
                case 'country':
                    $name = $faker->country;
                    break;
                case 'region':
                    $name = $faker->state;
                    break;
                case 'city':
                    $name = $faker->city;
                    break;
                case 'place':
                    $name = $faker->address;
                    break;
            }

            $location_id = $i > 1 ? $faker->optional()->numberBetween(1, $i - 1) : NULL;

            DB::table('locations')->insert([
                'name' => $name,
                'location_id' => $location_id,
                'type' => $type,
                'description' => $faker->text(),
                'image_link' => $faker->imageUrl(),
                'created_at' => now(),
            ]);
        }
    }
}
