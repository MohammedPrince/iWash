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

        Schema::create('tbl_booking', function (Blueprint $table) {
            
            $table->id();
            $table->integer('user_id')->comment('Foreignkeyto`users`table, identifyingcustomer');
            $table->integer('service_id'); 
            $table->integer('vehicle_id'); 
            $table->integer('service_provider_id')->nullable()->default(0)->comment('Foreignkeyto`users`table, must be service provider id');
            $table->date('start_date');
            $table->string('booking_time');
            $table->date('end_date')->nullable();
            $table->longText('user_note')->nullable();
            $table->longText('service_provider_note')->nullable();
            $table->enum('status', ["pending","confirmed","declined","canceled","blocked","deleted"])->default('pending')->comment('pending,confirmed,declined,canceled,deleted');
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
            $table->timestamp('deleted_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_booking');
    }
};
