<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabOrdersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'lab_orders';

    /**
     * Run the migrations.
     * @table lab_orders
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->unsignedInteger('vendor_id')->nullable()->default(null);
            $table->string('method', 191)->nullable()->default(null);
            $table->integer('totalQty');
            $table->double('pay_amount');
            $table->string('timing', 191)->nullable()->default(null);
            $table->string('status', 191);
            $table->string('currency_sign', 191);
            $table->double('currency_value');
            $table->string('customer_name', 191);
            $table->string('customer_email', 191);
            $table->string('customer_phone', 191);
            $table->string('customer_address', 191)->nullable()->default(null);
            $table->text('customer_details')->nullable()->default(null);
        
            $table->string('order_number', 191);
            $table->double('service_charge')->default('0.00');
            $table->double('discount')->default('0.00');
            $table->string('txnid', 191)->nullable()->default(null);
            $table->string('latlong', 191)->nullable()->default(null);
            $table->string('note', 191)->nullable()->default(null);

            $table->index(["vendor_id"], 'lab_orders_vendor_id_foreign');

            $table->index(["user_id"], 'lab_orders_user_id_foreign');

        
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
