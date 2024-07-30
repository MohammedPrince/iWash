<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('password');
            $table->string('phone');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verified')->nullable()->default('no');
            $table->string('image_url');
            $table->integer('role_id');
            $table->enum('login_type', ["mobile","email","google","apple"])->default('mobile');
            $table->string('login_identity');
            $table->enum('status', ["active","inactive","blocked","deleted"])->nullable()->default('active');
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
            $table->timestamp('deleted_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_users');
    }
};
