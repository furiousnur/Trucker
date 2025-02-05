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
        Schema::table('location_prices', function (Blueprint $table) {
            $table->string('settings_truck_key')->nullable()->after('price');
            $table->string('settings_truck_value')->nullable()->after('settings_truck_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('location_prices', function (Blueprint $table) {
            $table->dropColumn('settings_key');
            $table->dropColumn('settings_value');
        });
    }
};
