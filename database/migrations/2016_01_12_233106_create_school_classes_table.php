<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('schools', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('title');
        //     $table->string('district');
        //     $table->string('description');
        //     $table->timestamps();
        // });

        Schema::create('school_classes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->integer('grade_num');
            $table->integer('class_num');
            $table->integer('school_id')->unsigned();
            $table->timestamps();

            $table->foreign('school_id')
                  ->references('id')
                  ->on('schools')
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
        Schema::dropIfExists('school_classes');
        // Schema::dropIfExists('schools');

    }
}
