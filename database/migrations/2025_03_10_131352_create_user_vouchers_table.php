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
        Schema::create('user_vouchers', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'user_vouchers_id'
            )->onDelete('cascade');
             $table->foreignId('voucher_id')->constrained(
                table: 'vouchers',
                indexName: 'vourcher_user_id'
            )->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_vouchers');
    }
};
