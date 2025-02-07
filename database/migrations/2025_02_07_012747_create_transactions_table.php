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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->foreignId(column: 'user_id')->constrained(
                table: 'users',
                indexName: 'transaction_user_id'
            );
            $table->foreignId(column: 'summary_id')->constrained(
                table: 'summaries',
                indexName: 'transaction_summary_id'
            );
            $table->foreignId(column: 'cart_id')->constrained(
                table: 'carts',
                indexName: 'transaction_cart_id'
            );
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};