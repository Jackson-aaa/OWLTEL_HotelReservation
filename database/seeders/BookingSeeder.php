<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<5; $i++){
            DB::table('bookings')->insert([
                'user_id' => 1,
                'hotel_id' => 1,
                'check_in' => fake()->dateTime(),
                'check_out' => fake()->dateTime(),
                'total_price' => fake()->numberBetween(550000, 35000000),
                'booking_for' => 'Shannie',
                'booking_date' => fake()->dateTime(),
                'status' => 'Pending'
            ]);
        }
    }
}
