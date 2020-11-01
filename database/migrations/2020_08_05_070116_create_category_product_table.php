<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'category_product';

    /**
     * Run the migrations.
     * @table category_product
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('subcategory_id');
            $table->unsignedInteger('childcategory_id');

            $table->index(["category_id"], 'category_product_category_id_foreign');

            $table->index(["product_id"], 'category_product_product_id_foreign');

            $table->index(["subcategory_id"], 'category_product_subcategory_id_foreign');

            $table->index(["childcategory_id"], 'category_product_childcategory_id_foreign');
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
