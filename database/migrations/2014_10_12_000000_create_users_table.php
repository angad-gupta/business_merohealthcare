
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 191);
            $table->string('photo', 191)->nullable()->default(null);
            $table->string('zip', 191)->nullable()->default(null);
            $table->string('residency', 191)->nullable()->default(null);
            $table->string('city', 191)->nullable()->default(null);
            $table->string('address', 191)->nullable()->default(null);
            $table->string('phone', 191)->nullable()->default(null);
            $table->string('fax', 191)->nullable()->default(null);
            $table->string('email', 191);
            $table->string('password', 191)->nullable()->default(null);
            $table->tinyInteger('is_provider')->default('0');
            $table->string('shop_name', 191)->nullable()->default(null);
            $table->string('owner_name', 191)->nullable()->default(null);
            $table->string('shop_number', 191)->nullable()->default(null);
            $table->string('shop_address', 191)->nullable()->default(null);
            $table->string('reg_number', 191)->nullable()->default(null);
            $table->text('shop_message')->nullable()->default(null);
            $table->tinyInteger('is_vendor')->default('0');
            $table->text('shop_details')->nullable()->default(null);
            $table->string('f_url', 191)->nullable()->default(null);
            $table->string('g_url', 191)->nullable()->default(null);
            $table->string('t_url', 191)->nullable()->default(null);
            $table->string('l_url', 191)->nullable()->default(null);
            $table->tinyInteger('f_check')->nullable()->default('0');
            $table->tinyInteger('g_check')->nullable()->default('0');
            $table->tinyInteger('t_check')->nullable()->default('0');
            $table->tinyInteger('l_check')->nullable()->default('0');
            $table->integer('shipping_cost')->default('0');
            $table->integer('current_balance')->default('0');
            $table->string('affilate_code', 191)->nullable()->default(null);
            $table->double('affilate_income')->nullable()->default('0');
            $table->date('date')->nullable()->default(null);
            $table->tinyInteger('mail_sent')->default('0');
            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->rememberToken();
            $table->string('activation_code', 191)->nullable()->default(null);
            $table->string('nearest_landmark', 191)->nullable()->default(null);
            $table->string('address_type', 191)->nullable()->default(null);
            $table->string('pan_number', 191)->nullable()->default(null);
            $table->text('service_areas')->nullable()->default(null);
            $table->string('latlong', 191)->nullable()->default(null);
            $table->string('user_type', 191)->default('user');
            $table->date('dob')->nullable()->default(null);
            $table->string('company_name', 191)->nullable()->default(null);
            $table->string('registration_number', 191)->nullable()->default(null);
            $table->string('pan_vat', 191)->nullable()->default(null);
            $table->string('registration_file', 191)->nullable()->default(null);
            $table->string('company_details', 191)->nullable()->default(null);
            $table->timestamp('verified_at')->nullable()->default(null);
            $table->string('gender', 191)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->string('link', 191)->nullable()->default(null);
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