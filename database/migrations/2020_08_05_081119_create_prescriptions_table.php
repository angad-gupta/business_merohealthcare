<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'prescriptions';

    /**
     * Run the migrations.
     * @table prescriptions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 191);
            $table->string('email', 191);
            $table->string('phone', 191);
            $table->string('location', 191);
            $table->string('file', 191)->nullable()->default(null);
            $table->text('additional_info')->nullable()->default(null);
            $table->string('status', 191)->nullable()->default(null);
            $table->unsignedInteger('user_id')->nullable()->default(null);
  
            $table->string('title', 191)->nullable()->default(null);
            $table->string('latlong', 191)->nullable()->default(null);
            $table->string('type', 191)->default('medicine');

            $table->index(["user_id"], 'prescriptions_user_id_foreign');

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
