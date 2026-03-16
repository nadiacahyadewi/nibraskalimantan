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
        Schema::table('orders', function (Blueprint $table) {
            // Using raw SQL because Laravel's ->change() on enums can be tricky
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('Menunggu Konfirmasi', 'Menunggu Pembayaran', 'Dibayar', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan') DEFAULT 'Menunggu Konfirmasi'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('Menunggu Konfirmasi', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan') DEFAULT 'Menunggu Konfirmasi'");
        });
    }
};
