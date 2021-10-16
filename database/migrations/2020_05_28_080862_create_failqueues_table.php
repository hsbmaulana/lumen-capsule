<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailqueuesTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('failqueues', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('uuid')->unique();
            $table->string('connection');
            $table->string('queue');
            $table->longText('payload');
            $table->longText('exception');

            $table->timestamp('failed_at', 0)->useCurrent();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failqueues');
    }

}