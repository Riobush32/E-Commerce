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
        Schema::table('summaries', function (Blueprint $table) {
            $table->string('orderid')->after('payment')->nullable();
            $table->string('snap_token')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('summaries', function (Blueprint $table) {
            $table->dropColumn('orderid');
            $table->dropColumn('snap_token');
        });
    }
};