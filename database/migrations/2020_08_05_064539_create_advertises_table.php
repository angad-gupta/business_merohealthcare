<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'advertises';

    /**
     * Run the migrations.
     * @table advertises
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('type', 191);
            $table->string('photo', 191)->nullable()->default(null);
            $table->string('alt', 191)->nullable()->default(null);
            $table->string('url', 191)->nullable()->default(null);
            $table->text('script')->nullable()->default(null);
            $table->string('size', 191)->nullable()->default(null);
            $table->integer('clicks')->default('0');
            $table->tinyInteger('status')->default('0');
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
