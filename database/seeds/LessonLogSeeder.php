<?php

use Illuminate\Database\Seeder;

class LessonLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lesson_logs')->delete();

        DB::table('lesson_logs')->insert([
            ['user_id' => 2, 'school_class_id' => 9, 'lesson_id' => 1, 'status' => 'close'],
        ]);
    }
}
