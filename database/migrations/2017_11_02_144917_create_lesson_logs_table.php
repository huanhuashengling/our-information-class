<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonLogsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'lesson_logs';

    /**
     * Run the migrations.
     * @table lesson_logs
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('lessons_id')->unsigned();
            $table->string('status', 45)->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->integer('teachers_id')->unsigned();
            $table->integer('sclasses_id')->unsigned();

            $table->index(["teachers_id"], 'fk_lesson_logs_teachers1_idx');

            $table->index(["lessons_id"], 'fk_lesson_logs_lessons1_idx');

            $table->index(["sclasses_id"], 'fk_lesson_logs_sclasses1_idx');
            $table->nullableTimestamps();

            $table->foreign('lessons_id', 'fk_lesson_logs_lessons1_idx')
                ->references('id')
                ->on('lessons')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('teachers_id', 'fk_lesson_logs_teachers1_idx')
                ->references('id')
                ->on('teachers')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('sclasses_id', 'fk_lesson_logs_sclasses1_idx')
                ->references('id')
                ->on('sclasses')
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
