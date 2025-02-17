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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            //foreign key user
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'user_cart_id'
            )->onDelete('cascade');
            //foreign key variant
            $table->foreignId('variant_id')->constrained(
                table: 'variants',
                indexName: 'variant_cart_id'
            )->onDelete('cascade');
            $table->string('status')->default('cart');
            ////////////////////////////////
            $table->integer('quantity');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};