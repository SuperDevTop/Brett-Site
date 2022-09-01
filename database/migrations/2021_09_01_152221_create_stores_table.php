<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('stores', function (Blueprint $table) {
            $table->id('bussiness_user_id')->nullable();
            $table->string('name');
            $table->string('category')->nullable();
            $table->longText('address')->nullable();
            $table->string('email')->nullable();
            $table->string('logo', 2048)->nullable();
            $table->longText('description')->nullable();
            $table->string('link_to_website_listing_page')->nullable();
            $table->string('phone')->nullable();
            $table->string('link_with_social_media')->nullable();
            $table->longText('store_hours')->nullable();
            $table->integer('status')->comment('1=active, 0=Deactive');
            $table->string('lat', 2048)->nullable();
            $table->string('long', 2048)->nullable();

            $table->longText('delivery_service_info')->nullable();
            $table->longText('about_us_info')->nullable();
            

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
        Schema::dropIfExists('stores');
    }
}
