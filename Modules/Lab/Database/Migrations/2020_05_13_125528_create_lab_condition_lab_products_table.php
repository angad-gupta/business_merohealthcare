<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabConditionLabProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_condition_lab_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lab_product_id')->unsigned();
            $table->integer('lab_condition_id')->unsigned();
            $table->foreign('lab_product_id')->references('id')->on('lab_products')->onDelete('cascade');
            $table->foreign('lab_condition_id')->references('id')->on('lab_conditions')->onDelete('cascade');
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
        Schema::dropIfExists('lab_condition_lab_products');
    }
}
