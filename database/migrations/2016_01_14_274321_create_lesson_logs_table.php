<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_logs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->integer('school_classes_id')->unsigned();
            $table->integer('lesson_id')->unsigned();
            $table->string('status');
            $table->timestamps();

            $table->foreign('users_id')
                  ->references('users_id')
                  ->on('teachers')
                  ->onDelete('cascade');

            $table->foreign('school_classes_id')
                  ->references('id')
                  ->on('school_classes')
                  ->onDelete('cascade');

            $table->foreign('lesson_id')
                  ->references('id')
                  ->on('lessons')
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
        Schema::dropIfExists('lesson_logs');
    }
}
