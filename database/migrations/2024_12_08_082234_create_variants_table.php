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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            //foreign key variant
            $table->foreignId('product_id')->constrained(
                table: 'products',
                indexName: 'product_variant_id'
            )->onDelete('cascade');
            $table->string('variant_image')->nullable();
            $table->double('weight');
            $table->double('stock')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};