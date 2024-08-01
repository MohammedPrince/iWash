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


        Schema::create('tbl_locations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('Foreignkeyto`users`table, identifyingcustomer');
            $table->text('latitude');
            $table->text('longitude');
            $table->string('address');
            $table->string('city');
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
        Schema::dropIfExists('tbl_locations');
    }
};
