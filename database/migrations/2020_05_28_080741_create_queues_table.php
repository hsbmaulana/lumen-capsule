<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueuesTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('queues', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('queue');

            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');

            $table->unsignedInteger('reserved_at')->nullable(true);
            $table->unsignedInteger('available_at')->nullable(false);
            $table->unsignedInteger('created_at')->nullable(false);

            $table->index(['queue', 'reserved_at']);
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queues');
    }

}