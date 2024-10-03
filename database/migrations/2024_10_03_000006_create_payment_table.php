<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("payments", function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->timestamps();
        });

        Schema::create("payment_details", function (Blueprint $table) {
            $table->id();
            $table->foreignId("payment_id")->constrained();
            $table->string("name")->unique();
            $table->string("description")->nullable();
            $table->string("icon_link")->nullable();
            $table->timestamps();
        });

        Schema::create("extra_fees", function (Blueprint $table) {
            $table->id();
            $table->decimal("percentage");
            $table->string("name");
            $table->foreignId("payment_detail_id")->nullable()->constrained();
            $table->boolean("is_required")->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('payment_details');
        Schema::dropIfExists('extra_fees');
    }
};