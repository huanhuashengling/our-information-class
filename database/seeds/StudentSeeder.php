<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete();

        DB::table('students')->insert([
            ['user_id' => 3, 'school_class_id' => 9, 'level' => 1, 'score' => 12],
            ['user_id' => 4, 'school_class_id' => 9, 'level' => 1, 'score' => 12],
            ['user_id' => 5, 'school_class_id' => 9, 'level' => 1, 'score' => 12],
            ['user_id' => 6, 'school_class_id' => 9, 'level' => 1, 'score' => 12],
            ['user_id' => 7, 'school_class_id' => 9, 'level' => 1, 'score' => 12],
            ['user_id' => 8, 'school_class_id' => 9, 'level' => 1, 'score' => 12],
            ['user_id' => 9, 'school_class_id' => 9, 'level' => 1, 'score' => 12],
            ['user_id' => 10, 'school_class_id' => 9, 'level' => 1, 'score' => 12],
            ['user_id' => 11, 'school_class_id' => 9, 'level' => 1, 'score' => 12],
            ['user_id' => 12, 'school_class_id' => 9, 'level' => 1, 'score' => 12],
        ]);
    }
}
