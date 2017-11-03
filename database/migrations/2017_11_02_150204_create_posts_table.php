<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'posts';

    /**
     * Run the migrations.
     * @table posts
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('lesson_logs_id')->unsigned();
            $table->string('file_path', 45);
            $table->string('post_code')->nullable();
            $table->text('content')->nullable();
            $table->integer('students_id')->unsigned();

            $table->index(["lesson_logs_id"], 'fk_posts_lesson_logs1_idx');

            $table->index(["students_id"], 'fk_posts_students1_idx');
            $table->nullableTimestamps();


            $table->foreign('lesson_logs_id', 'fk_posts_lesson_logs1_idx')
                ->references('id')->on('lesson_logs')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('students_id', 'fk_posts_students1_idx')
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
