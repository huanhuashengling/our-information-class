<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'teachers';

    /**
     * Run the migrations.
     * @table teachers
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username', 45);
            $table->string('email', 45)->nullable();
            $table->string('password');
            $table->string('remember_token');
            $table->integer('schools_id')->unsigned();

            $table->index(["schools_id"], 'fk_teachers_schools2_idx');
            $table->nullableTimestamps();

            $table->foreign('schools_id', 'fk_teachers_schools2_idx')
                ->references('id')
                ->on('schools')
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
