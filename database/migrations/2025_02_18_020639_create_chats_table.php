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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            //foreign key product
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'user_chat_id'
            )->onDelete('cascade');
            $table->foreignId('to_user_id')->constrained(
                table: 'users',
                indexName: 'to_user_chat_id'
            )->onDelete('cascade');
            $table->foreignId('product_id')->constrained(
                table: 'products',
                indexName: 'product_chat_id'
            )->onDelete('cascade')->nullable();
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};