<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->text('address')->change();
            $table->float('initial_price')->change();
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->float('total_price')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', callback: function (Blueprint $table) {
            $table->string('address')->change();
            $table->decimal('initial_price')->change();
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('totcolumn: al_price')->change();
        });
    }
};
