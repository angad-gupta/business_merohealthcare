<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabProductUserTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'lab_product_user';

    /**
     * Run the migrations.
     * @table lab_product_user
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->double('cprice');
            $table->double('pprice')->nullable()->default(null);
            $table->string('timing', 191);
            $table->string('report_delivery_time', 191);
            $table->tinyInteger('status')->default('1');
            $table->string('specimen', 191)->nullable()->default(null);
            $table->string('method', 191)->nullable()->default(null);

            $table->index(["user_id"], 'lab_product_user_user_id_foreign');

            $table->index(["product_id"], 'lab_product_user_product_id_foreign');
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
