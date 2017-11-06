<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'students';

    /**
     * Run the migrations.
     * @table students
     *alter table `students` add constraint `fk_students_groups1_idx` foreign key (`groups_id`) references `groups` (`id`) on delete no action on update no action
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username');
            $table->string('email')->nullable();
            $table->string('gender', 45)->nullable();
            $table->string('level', 45)->nullable();
            $table->string('score', 45)->nullable();
            $table->string('password');
            $table->string('remember_token');
            $table->integer('groups_id')->unsigned()->nullable();
            $table->integer('sclasses_id')->unsigned();

            $table->index(["sclasses_id"], 'fk_students_sclasses1_idx');

            $table->index(["groups_id"], 'fk_students_groups1_idx');
            $table->nullableTimestamps();

            $table->foreign('groups_id', 'fk_students_groups1_idx')
                ->references('id')
                ->on('groups')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('sclasses_id', 'fk_students_sclasses1_idx')
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
