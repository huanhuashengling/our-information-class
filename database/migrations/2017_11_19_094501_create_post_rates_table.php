<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostRatesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'post_rates';

    
    /**
     * Run the migrations.
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
            $table->string('rate', 45)->nullable();
            $table->integer('teachers_id')->unsigned();

            $table->index(["teachers_id"], 'fk_post_rates_teachers1_idx');

            $table->index(["posts_id"], 'fk_post_rates_posts1_idx');
            $table->nullableTimestamps();


            $table->foreign('posts_id', 'fk_post_rates_posts1_idx')
                ->references('id')->on('posts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('teachers_id', 'fk_post_rates_teachers1_idx')
                ->references('id')->on('teachers')
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
        Schema::dropIfExists('post_rates');
    }
}
