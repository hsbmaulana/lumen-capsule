<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCachesTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('caches', function (Blueprint $table) {

            $table->string('key')->unique();

            $table->mediumText('value');
            $table->integer('expiration');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caches');
    }
}