<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionfilePrescriptionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'prescriptionfile_prescriptions';

    /**
     * Run the migrations.
     * @table prescriptionfile_prescriptions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('prescription_id');
            $table->unsignedInteger('prescriptionfile_id');

            $table->index(["prescription_id"], 'prescriptionfile_prescriptions_prescription_id_foreign');

            $table->index(["prescriptionfile_id"], 'prescriptionfile_prescriptions_prescriptionfile_id_foreign');
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
