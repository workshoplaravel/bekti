<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRechecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rechecks', function (Blueprint $table) {
            $table->integer('stemming_id')->unsigned();
            $table->integer('dictionary_id')->unsigned();
            $table->timestamps();

            $table->foreign('stemming_id')
                ->references('id')->on('stemmings')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('dictionary_id')
                ->references('id')->on('dictionaries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rechecks');
    }
}
