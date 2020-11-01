<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabProductsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'lab_products';

    /**
     * Run the migrations.
     * @table lab_products
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 191);
            $table->string('slug', 191)->nullable()->default(null);
            $table->string('photo', 191)->nullable()->default(null);
            $table->text('description');
            $table->tinyInteger('status')->default('1');
            $table->string('type', 191)->default('Test');
            $table->string('product_collection', 191)->nullable()->default(null);

            $table->unique(["slug"], 'lab_products_slug_unique');
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
