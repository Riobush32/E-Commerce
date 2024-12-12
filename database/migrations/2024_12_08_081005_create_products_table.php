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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            //foreing key
            $table->foreignId('category_id')->constrained(
                table: 'categories',
                indexName: 'product_category_id'
            );
            $table->foreignId('brand_id')->constrained(
                table: 'brands',
                indexName: 'product_brand_id'
            );
            ////////////////////////////////////
            $table->double('rating')->nullable();
            $table->double('sold')->nullable();
            $table->text('description')->nullable();
            $table->text('info')->nullable();
            $table->integer('stock')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
