<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabCategoryProductTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'lab_category_product';

    /**
     * Run the migrations.
     * @table lab_category_product
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('lab_product_id');
            $table->unsignedInteger('lab_category_id');

            $table->index(["lab_category_id"], 'lab_category_product_lab_category_id_foreign');

            $table->index(["lab_product_id"], 'lab_category_product_lab_product_id_foreign');
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
