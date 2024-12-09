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
        Schema::create('product_photos', function (Blueprint $table) {
            $table->id();
            //foreign key product
            $table->foreignId('product_id')->constrained(
                table: 'products',
                indexName: 'product_photo_id'
            );
            ////////////////////////////////
            $table->string('photo_patch');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_photos');
    }
};
