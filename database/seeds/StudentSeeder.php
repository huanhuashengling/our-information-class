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
            ['users_id' => 3, 'gender' => 0, 'school_classes_id' => 9, 'level' => 1, 'score' => 12],
            ['users_id' => 4, 'gender' => 1, 'school_classes_id' => 9, 'level' => 1, 'score' => 12],
            ['users_id' => 5, 'gender' => 0, 'school_classes_id' => 9, 'level' => 1, 'score' => 12],
            ['users_id' => 6, 'gender' => 1, 'school_classes_id' => 9, 'level' => 1, 'score' => 12],
            ['users_id' => 7, 'gender' => 0, 'school_classes_id' => 9, 'level' => 1, 'score' => 12],
            ['users_id' => 8, 'gender' => 1, 'school_classes_id' => 9, 'level' => 1, 'score' => 12],
            ['users_id' => 9, 'gender' => 0, 'school_classes_id' => 9, 'level' => 1, 'score' => 12],
            ['users_id' => 10, 'gender' => 1, 'school_classes_id' => 9, 'level' => 1, 'score' => 12],
            ['users_id' => 11, 'gender' => 1, 'school_classes_id' => 9, 'level' => 1, 'score' => 12],
            ['users_id' => 12, 'gender' => 0, 'school_classes_id' => 9, 'level' => 1, 'score' => 12],
        ]);
    }
}
