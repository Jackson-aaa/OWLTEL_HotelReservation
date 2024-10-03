<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("price", function (Blueprint $table) {
            $table->id();
            $table->enum("type", ["weekday", "weekend", "public_holiday"]);
            $table->decimal("percentage");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("price");
    }
};