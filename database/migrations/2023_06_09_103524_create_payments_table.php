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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->string('amount');
            $table->string('payment_date');
            $table->string('payment_type');
            $table->string('p_bkash_number')->nullable();
            $table->string('b_ref_number')->nullable();
            $table->string('p_nagad_number')->nullable();
            $table->string('n_ref_number')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_name')->nullable();
            $table->text('review')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
