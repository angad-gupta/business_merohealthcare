<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'sliders';

    /**
     * Run the migrations.
     * @table sliders
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 191)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->string('photo', 191);
            $table->string('position', 100)->nullable()->default(null);
            $table->string('title_size', 100)->nullable()->default(null);
            $table->string('title_color', 100)->nullable()->default(null);
            $table->string('title_anime', 100)->nullable()->default(null);
            $table->string('desc_size', 100)->nullable()->default(null);
            $table->string('desc_color', 100)->nullable()->default(null);
            $table->string('desc_anime', 100)->nullable()->default(null);
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

