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
            ['id' => 2, 'teachers_users_id' => 2, 'school_classes_id' => 9, 'lessons_id' => 2, 'status' => 'close'],
            ['id' => 3, 'teachers_users_id' => 2, 'school_classes_id' => 9, 'lessons_id' => 3, 'status' => 'close'],
            ['id' => 4, 'teachers_users_id' => 2, 'school_classes_id' => 9, 'lessons_id' => 4, 'status' => 'close'],
            ['id' => 5, 'teachers_users_id' => 2, 'school_classes_id' => 9, 'lessons_id' => 5, 'status' => 'open'],
        ]);
    }
}
