<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'blogs';

    /**
     * Run the migrations.
     * @table blogs
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 191);
            $table->text('details');
            $table->string('photo', 191)->nullable()->default(null);
            $table->string('source', 191);
            $table->integer('views')->default('0');
            $table->tinyInteger('status')->default('1');
            $table->text('meta_tag')->nullable()->default(null);
            $table->text('meta_description')->nullable()->default(null);
            $table->string('slug', 191)->nullable()->default(null);
            $table->string('filename', 191)->nullable()->default(null);

            $table->unique(["slug"], 'blogs_slug_unique');
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
