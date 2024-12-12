<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("hotels", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->string("address");
            $table->foreignId("location_id")->constrained();
            $table->decimal("initial_price");
            $table->string("image_link")->nullable();
            $table->timestamps();
        });

        Schema::create("facilities", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("icon_link")->nullable();
            $table->timestamps();
        });

        Schema::create("hotel_facilities", function (Blueprint $table) {
            $table->id();
            $table->foreignId("hotel_id")->constrained();
            $table->foreignId("facility_id")->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("hotels");
        Schema::dropIfExists("facilities");
        Schema::dropIfExists("hotel_facilities");
    }
};
