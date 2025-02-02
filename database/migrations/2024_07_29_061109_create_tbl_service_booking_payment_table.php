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

        Schema::create('tbl_service_booking_payment', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id');
            $table->integer('service_provider_id');
            $table->integer('payment_provider_id');
            $table->string('payment_transactintion_id');
            $table->double('amount');
            $table->dateTime('date');
            $table->enum('payment_status', ["pending","received","rejected"])->nullable()->default('pending');
            $table->enum('status', ["active","inactive","blocked","deleted"])->nullable()->default('active');
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
            $table->timestamp('deleted_at')->useCurrent()->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_service_booking_payment');
    }
};
