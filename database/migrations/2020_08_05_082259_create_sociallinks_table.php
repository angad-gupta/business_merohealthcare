<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSociallinksTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'sociallinks';

    /**
     * Run the migrations.
     * @table sociallinks
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('facebook', 191);
            $table->string('gplus', 191);
            $table->string('twitter', 191);
            $table->string('linkedin', 191);
            $table->tinyInteger('f_status')->default('1');
            $table->tinyInteger('g_status')->default('1');
            $table->tinyInteger('t_status')->default('1');
            $table->tinyInteger('l_status')->default('1');
            $table->tinyInteger('fcheck')->nullable()->default(null);
            $table->tinyInteger('gcheck')->nullable()->default(null);
            $table->text('fclient_id')->nullable()->default(null);
            $table->text('fclient_secret')->nullable()->default(null);
            $table->text('fredirect')->nullable()->default(null);
            $table->text('gclient_id')->nullable()->default(null);
            $table->text('gclient_secret')->nullable()->default(null);
            $table->text('gredirect')->nullable()->default(null);
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
