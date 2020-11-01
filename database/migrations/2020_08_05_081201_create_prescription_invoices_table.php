<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionInvoicesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'prescription_invoices';

    /**
     * Run the migrations.
     * @table prescription_invoices
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('items');
            $table->double('amount');
            $table->double('tax')->default('0.00');
            $table->double('shipping_cost')->default('0.00');
            $table->text('note')->nullable()->default(null);
            $table->string('currency_sign', 191);
            $table->string('currency_value', 191);
            $table->unsignedInteger('prescription_id');

            $table->index(["prescription_id"], 'prescription_invoices_prescription_id_foreign');
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

