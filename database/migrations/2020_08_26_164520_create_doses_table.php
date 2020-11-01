<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'doses';

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('family_member_id')->unsigned()->nullable();
            $table->foreign('family_member_id')->references('id')->on('family_members')->onDelete('set null');
     
            $table->integer('medicine_stock_id')->unsigned()->nullable();
            $table->foreign('medicine_stock_id')->references('id')->on('medicine_stocks')->onDelete('set null');
            
            $table->boolean('has_reminders');
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
