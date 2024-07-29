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
            $table->bigInteger('payment_method_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->longText('user_note');
            $table->longText('service_provider_note');
            $table->enum('payment_status', ["pending","received","rejected"])->default('pending');
            $table->enum('status', ["active","inactive","blocked","deleted"])->default('active')->comment('active,inactive,blocked,deleted');
            $table->integer('action_by');
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
        Schema::dropIfExists('tbl_booking');
    }
};
