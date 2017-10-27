<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle');
            $table->string('help_md_doc');
            $table->string('allow_post_file_types');
            $table->integer('users_id')->unsigned();
            $table->timestamps();

            $table->foreign('users_id')
                  ->references('users_id')
                  ->on('teachers')
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
        Schema::dropIfExists('lessons');
    }
}
