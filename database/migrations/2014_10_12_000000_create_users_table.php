<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('lat', 2048)->nullable();
            $table->string('long', 2048)->nullable();
            $table->string('zip_code')->nullable();
            $table->dateTime('dob')->nullable();
            $table->string('redit_link')->nullable();
            $table->string('discord_link')->nullable();
            $table->integer('status')->comment('1=active, 0=Deactive');
            $table->integer('category')->comment('1=Doctors, 2=Dispensary, 3=Delivery Driver')->nullable();
            $table->enum('user_type', ['administrator', 'business', 'customer'])->default('customer')->comment('administrator,business,customer');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
