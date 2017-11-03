<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSclassesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'sclasses';

    /**
     * Run the migrations.
     * @table sclasses
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('schools_id')->unsigned();
            $table->integer('enter_school_year');
            $table->string('class_title', 45);
            $table->integer('class_num');

            $table->index(["schools_id"], 'fk_school_classes_schools1_idx');
            $table->nullableTimestamps();


            $table->foreign('schools_id', 'fk_school_classes_schools1_idx')
                ->references('id')->on('schools')
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
