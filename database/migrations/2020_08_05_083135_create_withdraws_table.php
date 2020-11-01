<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'withdraws';

    /**
     * Run the migrations.
     * @table withdraws
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->nullable()->default(null);
            $table->string('method')->nullable()->default(null);
            $table->string('acc_email')->nullable()->default(null);
            $table->string('iban')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->string('acc_name')->nullable()->default(null);
            $table->text('address')->nullable()->default(null);
            $table->string('swift')->nullable()->default(null);
            $table->text('reference')->nullable()->default(null);
            $table->float('amount')->nullable()->default(null);
            $table->float('fee')->nullable()->default('0');
            $table->enum('status', ['pending', 'completed', 'rejected'])->default('pending');
            $table->string('type', 10);
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
