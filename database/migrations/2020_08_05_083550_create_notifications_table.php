<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'notifications';

    /**
     * Run the migrations.
     * @table notifications
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('order_id')->nullable()->default(null);
            $table->integer('user_id')->nullable()->default(null);
            $table->integer('vendor_id')->nullable()->default(null);
            $table->integer('product_id')->nullable()->default(null);
            $table->integer('conversation_id')->nullable()->default(null);
            $table->tinyInteger('is_read')->default('0');
            $table->unsignedInteger('prescription_id')->nullable()->default(null);
            $table->unsignedInteger('vendor_product_id')->nullable()->default(null);

            $table->index(["vendor_product_id"], 'notifications_vendor_product_id_foreign');
            $table->nullableTimestamps();


            $table->foreign('vendor_product_id', 'notifications_vendor_product_id_foreign')
                ->references('id')->on('products')
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

