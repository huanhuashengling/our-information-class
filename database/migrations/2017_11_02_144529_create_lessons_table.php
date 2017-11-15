<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'lessons';

    /**
     * Run the migrations.
     * @table lessons
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('lesson_code', 45)->nullable();
            $table->string('title', 45);
            $table->string('subtitle', 45)->nullable();
            $table->string('allow_post_file_types', 45)->nullable();
            $table->text('help_md_doc')->nullable();
            $table->string('description')->nullable();
            $table->integer('teachers_id')->unsigned();

            $table->index(["teachers_id"], 'fk_lessons_teachers1_idx');
            $table->nullableTimestamps();

            $table->foreign('teachers_id', 'fk_lessons_teachers1_idx')
                ->references('id')
                ->on('teachers')
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
