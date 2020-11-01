<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabPrescriptionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'lab_prescriptions';

    /**
     * Run the migrations.
     * @table lab_prescriptions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->unsignedInteger('prescription_id')->nullable()->default(null);
            $table->string('lab_id', 191);
            $table->string('vendor_id', 191);
            $table->string('status', 191)->nullable()->default(null);

            $table->index(["user_id"], 'lab_prescriptions_user_id_foreign');

            $table->index(["prescription_id"], 'lab_prescriptions_prescription_id_foreign');
            $table->nullableTimestamps();


            $table->foreign('prescription_id', 'lab_prescriptions_prescription_id_foreign')
                ->references('id')->on('prescriptions')
                ->onDelete('set null')
                ->onUpdate('restrict');

            $table->foreign('user_id', 'lab_prescriptions_user_id_foreign')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('restrict');
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

