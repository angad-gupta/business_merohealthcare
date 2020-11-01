<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionfileOrdersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'prescriptionfile_orders';

    /**
     * Run the migrations.
     * @table prescriptionfile_orders
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order_id');
            $table->unsignedInteger('prescriptionfile_id');

            $table->index(["order_id"], 'prescriptionfile_orders_order_id_foreign');

            $table->index(["prescriptionfile_id"], 'prescriptionfile_orders_prescriptionfile_id_foreign');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
