<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarksTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'marks';

    /**
     * Run the migrations.
     * @table marks
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('posts_id')->unsigned();
            $table->integer('students_id')->unsigned();

            $table->index(["posts_id"], 'fk_marks_posts1_idx');

            $table->index(["students_id"], 'fk_marks_students1_idx');
            $table->nullableTimestamps();


            $table->foreign('posts_id', 'fk_marks_posts1_idx')
                ->references('id')->on('posts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('students_id', 'fk_marks_students1_idx')
                ->references('id')->on('students')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
