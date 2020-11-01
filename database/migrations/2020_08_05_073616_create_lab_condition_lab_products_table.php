<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabConditionLabProductsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'lab_condition_lab_products';

    /**
     * Run the migrations.
     * @table lab_condition_lab_products
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('lab_product_id');
            $table->unsignedInteger('lab_condition_id');

            $table->index(["lab_condition_id"], 'lab_condition_lab_products_lab_condition_id_foreign');

            $table->index(["lab_product_id"], 'lab_condition_lab_products_lab_product_id_foreign');
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
