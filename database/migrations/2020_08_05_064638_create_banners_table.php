<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'banners';

    /**
     * Run the migrations.
     * @table banners
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('top1', 191)->nullable()->default(null);
            $table->string('top2', 191)->nullable()->default(null);
            $table->string('top3', 191)->nullable()->default(null);
            $table->string('top4', 191)->nullable()->default(null);
            $table->string('bottom1', 191)->nullable()->default(null);
            $table->string('bottom2', 191)->nullable()->default(null);
            $table->string('top1l', 191)->nullable()->default(null);
            $table->string('top2l', 191)->nullable()->default(null);
            $table->string('top3l', 191)->nullable()->default(null);
            $table->string('top4l', 191)->nullable()->default(null);
            $table->string('bottom1l', 191)->nullable()->default(null);
            $table->string('bottom2l', 191)->nullable()->default(null);
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
