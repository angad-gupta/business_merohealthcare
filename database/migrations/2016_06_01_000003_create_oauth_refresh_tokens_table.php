<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthRefreshTokensTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'oauth_refresh_tokens';

    /**
     * Run the migrations.
     * @table oauth_refresh_tokens
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('access_token_id', 100);
            $table->tinyInteger('revoked');
            $table->dateTime('expires_at')->nullable()->default(null);

            $table->index(["access_token_id"], 'oauth_refresh_tokens_access_token_id_index');
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
