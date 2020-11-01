<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabOrderItemsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'lab_order_items';

    /**
     * Run the migrations.
     * @table lab_order_items
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('lab_order_id')->nullable()->default(null);
            $table->unsignedInteger('test_id')->nullable()->default(null);
            $table->string('test_name', 191);
            $table->double('test_price');
            $table->string('report_file', 191)->nullable()->default(null);

            $table->index(["test_id"], 'lab_order_items_test_id_foreign');

            $table->index(["lab_order_id"], 'lab_order_items_lab_order_id_foreign');
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
