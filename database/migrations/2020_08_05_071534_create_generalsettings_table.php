<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralsettingsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'generalsettings';

    /**
     * Run the migrations.
     * @table generalsettings
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('logo', 191)->nullable()->default(null);
            $table->string('favicon', 191);
            $table->string('title', 191);
            $table->string('site', 191)->nullable()->default(null);
            $table->string('bgimg', 191)->nullable()->default(null);
            $table->string('cimg', 191);
            $table->text('about');
            $table->text('street')->nullable()->default(null);
            $table->text('phone')->nullable()->default(null);
            $table->text('fax')->nullable()->default(null);
            $table->text('email')->nullable()->default(null);
            $table->text('footer');
            $table->string('bg_title', 191)->nullable()->default(null);
            $table->string('bg_link', 191)->nullable()->default(null);
            $table->text('bg_text')->nullable()->default(null);
            $table->integer('np')->default('0');
            $table->integer('fp')->default('0');
            $table->string('pb', 191)->nullable()->default(null);
            $table->string('sk', 191)->nullable()->default(null);
            $table->string('ss', 191)->nullable()->default(null);
            $table->tinyInteger('pcheck')->default('1');
            $table->tinyInteger('scheck')->default('1');
            $table->tinyInteger('mcheck')->default('1');
            $table->tinyInteger('bcheck')->default('1');
            $table->tinyInteger('ccheck')->default('1');
            $table->text('mmi');
            $table->text('bi');
            $table->unsignedInteger('ship');
            $table->string('vid', 191);
            $table->string('vidimg', 191);
            $table->text('tags')->nullable()->default(null);
            $table->tinyInteger('sign')->default('0');
            $table->tinyInteger('slider')->default('1');
            $table->tinyInteger('category')->default('1');
            $table->tinyInteger('sb')->default('1');
            $table->tinyInteger('hv')->default('1');
            $table->tinyInteger('ftp')->default('1');
            $table->tinyInteger('lp')->default('1');
            $table->tinyInteger('pp')->default('1');
            $table->tinyInteger('lb')->default('1');
            $table->tinyInteger('bs')->default('1');
            $table->tinyInteger('ts')->default('1');
            $table->tinyInteger('bl')->default('1');
            $table->string('colors', 191)->nullable()->default(null);
            $table->string('bimg', 191);
            $table->string('loader', 191);
            $table->string('count_title', 191)->nullable()->default(null);
            $table->string('count_heading', 191)->nullable()->default(null);
            $table->string('count_date', 191)->nullable()->default(null);
            $table->string('count_link', 191)->nullable()->default(null);
            $table->string('count_image', 191)->nullable()->default(null);
            $table->tinyInteger('service_section')->default('0');
            $table->text('order_title')->nullable()->default(null);
            $table->text('order_text')->nullable()->default(null);
            $table->string('cart_success', 191)->nullable()->default(null);
            $table->string('cart_error', 191)->nullable()->default(null);
            $table->string('wish_success', 191)->nullable()->default(null);
            $table->string('wish_error', 191)->nullable()->default(null);
            $table->string('wish_remove', 191)->nullable()->default(null);
            $table->string('compare_success', 191)->nullable()->default(null);
            $table->string('compare_error', 191)->nullable()->default(null);
            $table->string('compare_remove', 191)->nullable()->default(null);
            $table->string('invalid', 191)->nullable()->default(null);
            $table->string('color_change', 191)->nullable()->default(null);
            $table->string('size_change', 191)->nullable()->default(null);
            $table->string('coupon_found', 191)->nullable()->default(null);
            $table->string('no_coupon', 191)->nullable()->default(null);
            $table->string('coupon_already', 191)->nullable()->default(null);
            $table->integer('withdraw_charge')->nullable()->default('0');
            $table->integer('withdraw_fee')->default('0');
            $table->integer('fixed_commission')->nullable()->default('0');
            $table->integer('percentage_commission')->nullable()->default('0');
            $table->integer('tax')->nullable()->default('0');
            $table->tinyInteger('ship_info')->default('0');
            $table->integer('multiple_ship')->default('0');
            $table->tinyInteger('is_talkto')->default('1');
            $table->text('talkto')->nullable()->default(null);
            $table->string('subscribe_title', 191)->nullable()->default(null);
            $table->text('subscribe_text')->nullable()->default(null);
            $table->string('subscribe_image', 191)->nullable()->default(null);
            $table->tinyInteger('is_subscribe')->default('1');
            $table->tinyInteger('is_language')->default('1');
            $table->tinyInteger('reg_vendor')->default('1');
            $table->tinyInteger('rtl')->default('0');
            $table->tinyInteger('is_affilate')->default('0');
            $table->integer('affilate_charge')->default('0');
            $table->tinyInteger('guest_checkout')->nullable()->default('0');
            $table->string('affilate_banner', 100)->nullable()->default(null);
            $table->string('smtp_host')->nullable()->default(null);
            $table->string('smtp_port')->nullable()->default(null);
            $table->string('smtp_user')->nullable()->default(null);
            $table->string('smtp_pass')->nullable()->default(null);
            $table->string('from_email')->nullable()->default(null);
            $table->string('from_name')->nullable()->default(null);
            $table->tinyInteger('is_smtp')->default('0');
            $table->tinyInteger('is_comment')->default('0');
            $table->text('footer_background')->nullable()->default(null);
            $table->tinyInteger('is_loader')->default('1');
            $table->unsignedInteger('min_free_ship')->nullable()->default(null);
            $table->integer('vat')->default('0');
            $table->integer('lab_vat')->default('0');
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
