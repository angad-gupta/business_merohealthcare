<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabCategoryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_category_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lab_product_id')->unsigned();
            $table->foreign('lab_product_id')->references('id')->on('lab_products')->onDelete('cascade');

            $table->integer('lab_category_id')->unsigned();
            $table->foreign('lab_category_id')->references('id')->on('lab_categories')->onDelete('cascade');

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
        Schema::dropIfExists('lab_category_products');
    }
}
