<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'units';

    /**
     * Run the migrations.
     * @table units
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->integer('teachers_id')->unsigned();
            $table->integer('courses_id')->unsigned();

            $table->index(["teachers_id"], 'fk_units_teachers1_idx');
            $table->foreign('teachers_id', 'fk_units_teachers1_idx')
                ->references('id')
                ->on('teachers')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->index(["courses_id"], 'fk_units_courses1_idx');
            $table->foreign('courses_id', 'fk_units_courses1_idx')
                ->references('id')
                ->on('courses')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->nullableTimestamps();
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
