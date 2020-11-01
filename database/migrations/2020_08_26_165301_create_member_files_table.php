<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $tableName = 'member_files';

    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('medical_file_id')->unsigned()->nullable();
            $table->foreign('medical_file_id')->references('id')->on('medical_files')->onDelete('set null');

            $table->integer('family_member_id')->unsigned()->nullable();
            $table->foreign('family_member_id')->references('id')->on('family_members')->onDelete('set null');


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
