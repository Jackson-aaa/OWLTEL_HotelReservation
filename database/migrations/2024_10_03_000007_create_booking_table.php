<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("bookings", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->foreignId("hotel_id")->constrained();
            $table->dateTime("check_in");
            $table->dateTime("check_out");
            $table->decimal("total_price");
            $table->string("booking_for")->nullable();
            $table->dateTime("booking_date");
            $table->enum("status", ["Pending","Booked", "Done", "Cancelled"]);
            $table->timestamps();
        });

        Schema::create("reviews", function (Blueprint $table) {
            $table->id();
            $table->foreignId("booking_id")->constrained();
            $table->string("description")->nullable();
            $table->integer("score");
            $table->timestamps();
        });

        Schema::create("booking_payments", function (Blueprint $table) {
            $table->id();
            $table->foreignId("payment_detail_id")->constrained();
            $table->foreignId("booking_id")->constrained();
            $table->string("payment_information")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("bookings");
        Schema::dropIfExists("reviews");
        Schema::dropIfExists("booking_payments");
    }
};