<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFamilyIdToLabOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lab_orders', function (Blueprint $table) {
            $table->integer('family_id')->unsigned()->nullable();
            $table->foreign('family_id')->references('id')->on('families')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('', function (Blueprint $table) {

        });
    }
}
