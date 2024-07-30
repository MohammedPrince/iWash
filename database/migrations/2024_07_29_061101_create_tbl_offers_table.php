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
        Schema::disableForeignKeyConstraints();

        Schema::create('tbl_offers', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->string('name');
            $table->longText('desc');
            $table->bigInteger('discount');
            $table->enum('status', ["active","inactive","blocked","deleted"])->nullable()->default('active');
            $table->integer('created_by')->nullable()->default(0);
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
            $table->timestamp('deleted_at')->useCurrent()->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_offers');
    }
};
