<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToDoListTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('Task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->string('description', 250)->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('TaskList', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('description', 250)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('Task_TaskList', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task')->unsigned();
            $table->integer('tasklist')->unsigned();
            $table->integer('order');

            $table->foreign('task')->references('id')->on('Task');
            $table->foreign('tasklist')->references('id')->on('TaskList');
        });

        Schema::create('Task_User', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task')->unsigned();
            $table->integer('user')->unsigned();

            $table->foreign('task')->references('id')->on('Task');
            $table->foreign('user')->references('id')->on('User');
        });

        Schema::create('TaskList_User', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tasklist')->unsigned();
            $table->integer('user')->unsigned();

            $table->foreign('tasklist')->references('id')->on('TaskList');
            $table->foreign('user')->references('id')->on('User');
        });

        Schema::create('TaskLog', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task')->unsigned();
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('task')->references('id')->on('Task');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('Task');
        Schema::drop('TaskList');
        Schema::drop('Task_TaskList');
        Schema::drop('Task_User');
        Schema::drop('TaskList_User');
        Schema::drop('TaskLog');

    }

}
