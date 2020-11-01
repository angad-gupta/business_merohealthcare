<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'orders';

    /**
     * Run the migrations.
     * @table orders
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id');
            $table->text('cart');
            $table->string('method')->nullable()->default(null);
            $table->string('shipping')->nullable()->default(null);
            $table->string('pickup_location')->nullable()->default(null);
            $table->string('totalQty', 191);
            $table->float('pay_amount');
            $table->string('txnid')->nullable()->default(null);
            $table->string('charge_id')->nullable()->default(null);
            $table->string('order_number');
            $table->string('payment_status');
            $table->string('customer_email');
            $table->string('customer_name');
            $table->string('customer_country', 191);
            $table->string('customer_phone');
            $table->string('customer_address')->nullable()->default(null);
            $table->string('customer_city')->nullable()->default(null);
            $table->string('customer_zip')->nullable()->default(null);
            $table->string('shipping_name')->nullable()->default(null);
            $table->string('shipping_country', 191)->nullable()->default(null);
            $table->string('shipping_email')->nullable()->default(null);
            $table->string('shipping_phone')->nullable()->default(null);
            $table->string('shipping_address')->nullable()->default(null);
            $table->string('shipping_city')->nullable()->default(null);
            $table->string('shipping_zip')->nullable()->default(null);
            $table->text('order_note')->nullable()->default(null);
            $table->string('coupon_code', 191)->nullable()->default(null);
            $table->string('coupon_discount', 191)->nullable()->default(null);
            $table->enum('status', ['pending', 'processing', 'completed', 'declined', 'cancellation request'])->default('pending');
            $table->string('affilate_user', 191)->nullable()->default(null);
            $table->string('affilate_charge', 191)->nullable()->default(null);
            $table->string('currency_sign', 10);
            $table->double('currency_value');
            $table->double('shipping_cost');
            $table->integer('tax');
            $table->tinyInteger('dp')->default('0');
            $table->string('customer_landmark', 191)->nullable()->default(null);
            $table->string('customer_address_type', 191);
            $table->string('customer_pan_number', 191)->nullable()->default(null);
            $table->string('shipping_landmark', 191)->nullable()->default(null);
            $table->string('shipping_address_type', 191)->nullable()->default(null);
            $table->string('shipping_pan_number', 191)->nullable()->default(null);
            $table->timestamp('completed_at')->nullable()->default(null);
            $table->double('discount')->default('0.00');
            $table->string('customer_latlong', 191)->nullable()->default(null);
            $table->string('shipping_latlong', 191)->nullable()->default(null);
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
