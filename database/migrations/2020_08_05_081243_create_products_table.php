<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'products';

    /**
     * Run the migrations.
     * @table products
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('category_id')->nullable()->default(null);
            $table->unsignedInteger('subcategory_id')->nullable()->default(null);
            $table->unsignedInteger('childcategory_id')->nullable()->default(null);
            $table->integer('user_id')->default('0');
            $table->text('name');
            $table->string('photo', 191);
            $table->string('size', 191)->nullable()->default(null);
            $table->text('color')->nullable()->default(null);
            $table->float('cprice');
            $table->float('pprice')->nullable()->default(null);
            $table->text('description');
            $table->integer('stock')->nullable()->default(null);
            $table->text('policy')->nullable()->default(null);
            $table->unsignedTinyInteger('status')->default('1');
            $table->unsignedInteger('views')->default('0');
            $table->string('tags', 191)->nullable()->default(null);
            $table->unsignedTinyInteger('featured')->default('0');
            $table->unsignedTinyInteger('best')->default('0');
            $table->unsignedTinyInteger('top')->default('0');
            $table->unsignedTinyInteger('hot')->default('0');
            $table->unsignedTinyInteger('latest')->default('0');
            $table->unsignedTinyInteger('big')->default('0');
            $table->text('features')->nullable()->default(null);
            $table->text('colors')->nullable()->default(null);
            $table->tinyInteger('product_condition')->default('0');
            $table->string('ship', 191)->nullable()->default(null);
            $table->tinyInteger('is_meta')->default('0');
            $table->text('meta_tag')->nullable()->default(null);
            $table->text('meta_description')->nullable()->default(null);
            $table->string('youtube', 191)->nullable()->default(null);
            $table->tinyInteger('type')->default('0');
            $table->string('file', 191)->nullable()->default(null);
            $table->text('license')->nullable()->default(null);
            $table->text('license_qty')->nullable()->default(null);
            $table->text('link')->nullable()->default(null);
            $table->string('platform')->nullable()->default(null);
            $table->string('region')->nullable()->default(null);
            $table->string('licence_type')->nullable()->default(null);
            $table->string('measure', 191)->nullable()->default(null);
            $table->string('company_name', 191);
            $table->text('highlights')->nullable()->default(null);
            $table->tinyInteger('adv_price')->default('0');
            $table->string('sub_title', 191)->nullable()->default(null);
            $table->string('generic_name', 191)->nullable()->default(null);
            $table->double('sale_percentage')->nullable()->default(null);
            $table->string('sale_from', 191)->nullable()->default(null);
            $table->string('sale_to', 191)->nullable()->default(null);
            $table->tinyInteger('requires_prescription')->default('0');
            $table->integer('purchase_limit')->nullable()->default(null);
            $table->integer('sale_stock')->nullable()->default(null);
            $table->string('product_quantity', 191)->nullable()->default(null);
            $table->tinyInteger('vat_status')->default('0');
            $table->tinyInteger('approval')->default('1');
            $table->Integer('priority_order')->nullable();
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
