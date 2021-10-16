<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('name', 15)->unique();
            $table->string('email', 64)->unique();
            $table->text('password');

            $table->timestamp('email_verified_at', 0)->nullable(true);
            $table->timestamp('created_at', 0)->nullable(true);
            $table->timestamp('deleted_at', 0)->nullable(true);
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}