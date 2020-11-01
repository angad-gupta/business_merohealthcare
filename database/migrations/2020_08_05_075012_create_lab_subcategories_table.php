<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabSubcategoriesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'lab_subcategories';

    /**
     * Run the migrations.
     * @table lab_subcategories
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('category_id')->nullable()->default(null);
            $table->string('sub_name', 191);
            $table->string('sub_name_slug', 191);
            $table->tinyInteger('status')->default('1');
            $table->string('photo', 191);

            $table->index(["category_id"], 'lab_subcategories_category_id_foreign');

            $table->unique(["sub_name_slug"], 'lab_subcategories_sub_name_slug_unique');
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

