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
            $table->string('province')->nullable()->after('customer_address');
            $table->string('city')->nullable()->after('province');
            $table->string('district')->nullable()->after('city');
            $table->string('courier')->nullable()->after('district');
            $table->string('shipping_service')->nullable()->after('courier');
            $table->decimal('shipping_cost', 15, 2)->default(0)->after('shipping_service');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['province', 'city', 'district', 'courier', 'shipping_service', 'shipping_cost']);
        });
    }
};
