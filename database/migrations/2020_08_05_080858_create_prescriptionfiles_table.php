<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionfilesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'prescriptionfiles';

    /**
     * Run the migrations.
     * @table prescriptionfiles
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 191)->nullable()->default(null);
            $table->string('file', 191)->nullable()->default(null);
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->string('status', 191)->default('active');
         
            $table->string('folder_id', 191)->nullable()->default(null);

            $table->index(["user_id"], 'prescriptionfiles_user_id_foreign');
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
