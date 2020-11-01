<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'categories';

    /**
     * Run the migrations.
     * @table categories
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('cat_name', 100);
            $table->string('cat_slug', 191);
            $table->tinyInteger('status')->default('1');
            $table->string('photo', 191)->nullable()->default(null);
            $table->integer('priority_no')->default('1');

            $table->index(["id"], 'id');

            $table->unique(["cat_slug"], 'bloodgroups_slug_unique');
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
