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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['size_xs', 'size_s', 'size_m', 'size_l', 'size_xl', 'size_xxl']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('size_xs')->default(0);
            $table->integer('size_s')->default(0);
            $table->integer('size_m')->default(0);
            $table->integer('size_l')->default(0);
            $table->integer('size_xl')->default(0);
            $table->integer('size_xxl')->default(0);
        });
    }
};
