<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'doctors';

    /**
     * Run the migrations.
     * @table notifications
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->string('name');
        $table->string('email')->unique();
        $table->integer('nmc');
        $table->string('post');
        $table->string('photo');
        $table->text('description');
        $table->integer('status')->nullable();
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
