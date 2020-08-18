<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinfo', function (Blueprint $table) {
            $table->increments('id',10)->key();
            $table->string('name',255);
            $table->string('email',255)->nullable();
            $table->string('phone',10)->nullable();
            $table->string('city',255)->nullable();
            $table->dateTime('CreatedDate')->nullable();
            $table->dateTime('ModifiedDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('userinfo');
    }
}
