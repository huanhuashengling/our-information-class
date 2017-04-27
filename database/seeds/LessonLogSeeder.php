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
            ['id' => 1, 'teachers_users_id' => 2, 'school_classes_id' => 9, 'lessons_id' => 1, 'status' => 'close'],
        ]);
    }
}
