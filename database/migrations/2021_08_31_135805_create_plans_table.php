<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string("plane_name");
            $table->float("price");
            $table->string("image")->nullable();
            $table->longText("description")->nullable();
            $table->longText("plan_options_checkboxes")->nullable();
            $table->string("feature_listing_rotation")->nullable();
            $table->string("products_shoe_of_category")->nullable();
            $table->integer("category_id");
            $table->integer('status')->comment('1=active, 0=Deactive');
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
        Schema::dropIfExists('plans');
    }
}
