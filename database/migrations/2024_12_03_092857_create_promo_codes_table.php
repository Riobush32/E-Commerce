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
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            // $table->double('discount_amount',);
            // $table->string('conditions',)->nullable();
            // $table->string('description',)->nullable();
            // $table->datetime('period_start');
            // $table->datetime('period_end');
            // $table->string('code',)->nullable();
            // $table->string('color',)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_codes');
    }
};
