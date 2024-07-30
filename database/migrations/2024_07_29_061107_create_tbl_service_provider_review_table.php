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

        Schema::create('tbl_service_provider_review', function (Blueprint $table) {
            $table->id();
            $table->integer('service_provider_id')->comment('from users table when role_id == service provider');
            $table->integer('booking_id');
            $table->integer('customer_id')->comment('Foreignkeyto`users`table, identifyingcustomer');
            $table->longText('review_text');
            $table->dateTime('date');
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
        Schema::dropIfExists('tbl_service_provider_review');
    }
};
