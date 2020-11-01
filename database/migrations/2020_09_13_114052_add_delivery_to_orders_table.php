<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeliveryToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public $tableName = 'orders';
    public function up()
    {
        Schema::table($this->tableName, function (Blueprint $table) {
            $table->string('delivery_received_by')->nullable()->default(null);
            $table->dateTime('delivery_datetime')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
