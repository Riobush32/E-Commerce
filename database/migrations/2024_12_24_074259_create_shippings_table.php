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
        // 'cart_id' => $this->cart_id,
        // 'city' => $this->destination, // Gunakan kota tujuan
        // 'postal_code' => $this->postal_code ?? '', // Jika tersedia
        // 'shipping_cost' => $this->shipping_cost,
        // 'weight' => $this->weight,
        // 'courier' => $this->courier,
        // 'estimation' => $this->estimation,
        // 'service' => $this->service,
        // 'address' => $this->address,
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'shipping_user_id'
            )->onDelete('cascade');
            $table->string('no_hp');
            $table->string('province');
            $table->string('province_id');
            $table->string('city_id');
            $table->string('city_name');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('postal_code')->nullable();
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};