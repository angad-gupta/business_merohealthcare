<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubscriptionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_subscriptions';

    /**
     * Run the migrations.
     * @table user_subscriptions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('subscription_id');
            $table->text('title');
            $table->string('currency', 50);
            $table->string('currency_code', 50);
            $table->double('price')->default('0');
            $table->integer('days');
            $table->integer('allowed_products')->default('0');
            $table->text('details')->nullable()->default(null);
            $table->string('method', 50)->default('Free');
            $table->string('txnid')->nullable()->default(null);
            $table->string('charge_id')->nullable()->default(null);
            $table->integer('status')->default('0');
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

