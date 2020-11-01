<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCareerCandidatesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'career_candidates';

    /**
     * Run the migrations.
     * @table career_candidates
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('first_name', 191);
            $table->string('middle_name', 191)->nullable()->default(null);
            $table->string('last_name', 191);
            $table->string('email', 191)->nullable()->default(null);
            $table->string('portfolio', 191)->nullable()->default(null);
            $table->string('position', 191)->nullable()->default(null);
            $table->string('salary_requirements', 191)->nullable()->default(null);
            $table->string('start', 191)->nullable()->default(null);
            $table->string('phone', 191)->nullable()->default(null);
            $table->string('last_company', 191)->nullable()->default(null);
            $table->string('cv', 191)->nullable()->default(null);
            $table->text('comments')->nullable()->default(null);
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
