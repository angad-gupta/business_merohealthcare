<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesettingsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'pagesettings';

    /**
     * Run the migrations.
     * @table pagesettings
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('contact_success', 191);
            $table->string('contact_email', 191);
            $table->string('contact_title', 191)->nullable()->default(null);
            $table->text('contact_text')->nullable()->default(null);
            $table->text('about');
            $table->text('faq');
            $table->tinyInteger('c_status')->default('1');
            $table->tinyInteger('a_status')->default('1');
            $table->tinyInteger('f_status')->default('1');
            $table->string('bn', 191);
            $table->string('bnimg', 191);
            $table->tinyInteger('is_currency')->default('1');
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
