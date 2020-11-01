<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lab_order_id')->unsigned()->nullable();
            $table->integer('test_id')->unsigned()->nullable();
            $table->string('test_name');
            $table->float('test_price');
            $table->string('report_file')->nullable();
            $table->foreign('lab_order_id')->references('id')->on('lab_orders')->onDelete('cascade');
            $table->foreign('test_id')->references('id')->on('lab_product_user')->onDelete('set null');
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
        Schema::dropIfExists('lab_order_items');
    }
}
