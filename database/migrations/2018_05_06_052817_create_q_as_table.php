<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQAsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_as', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->text('answer_1')->nullable();
            $table->integer('rate_1')->nullable();
            $table->text('answer_2')->nullable();
            $table->integer('rate_2')->nullable();
            $table->text('answer_3')->nullable();
            $table->integer('rate_3')->nullable();
            $table->text('answer_4')->nullable();
            $table->integer('rate_4')->nullable();
            $table->text('answer_5')->nullable();
            $table->integer('rate_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_as');
    }
}
