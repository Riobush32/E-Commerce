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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('points_required')->default(0); // Poin yang dibutuhkan
            $table->date('valid_from')->nullable(); // Tanggal mulai berlaku
            $table->date('valid_until')->nullable(); // Tanggal akhir berlaku
            $table->decimal('min_purchase', 10, 2)->default(0); // Minimal belanja
            $table->enum('discount_type', ['percentage', 'fixed'])->default('fixed'); // Jenis diskon
            $table->decimal('discount_value', 10, 2)->default(0); // Nilai diskon
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
