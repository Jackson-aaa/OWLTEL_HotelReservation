<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Change the column to NVARCHAR(MAX)
            $table->text('description')->change();
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Revert the column to its previous size (e.g., NVARCHAR(255))
            $table->string('description', 255)->change();
        });
    }
};
