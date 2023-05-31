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
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_type');
            $table->string('nid')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->string('dr_lic_num')->nullable();
            $table->string('veh_reg_num')->nullable();
            $table->string('dob')->nullable();
            $table->string('monthly_income')->nullable();
            $table->string('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
