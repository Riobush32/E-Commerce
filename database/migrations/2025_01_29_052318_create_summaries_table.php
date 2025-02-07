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
        Schema::create('summaries', function (Blueprint $table) {
            $table->id();
            $table->double('payment');
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'summary_user_id'
            );
            $table->foreignId('shipping_id')->constrained(
                table: 'shippings',
                indexName: 'summary_shipping_id'
            );
            $table->double('shipping_cost');
            $table->double('discount')->nullable();
            $table->double('subtotal');
            $table->double('weight');
            $table->string('cart_selected');
            $table->string('estimations');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summaries');
    }
};