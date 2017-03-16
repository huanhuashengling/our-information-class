<?php

use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('school_classes')->delete();

        DB::table('school_classes')->insert([

            ['id' => 1, 'title' => '一甲', 'grade_num' => 1, 'class_num' => 1, 'school_id' => 1],
            ['id' => 2, 'title' => '一乙', 'grade_num' => 1, 'class_num' => 2, 'school_id' => 1],
            ['id' => 3, 'title' => '一丙', 'grade_num' => 1, 'class_num' => 3, 'school_id' => 1],
            ['id' => 4, 'title' => '一丁', 'grade_num' => 1, 'class_num' => 4, 'school_id' => 1],
            ['id' => 5, 'title' => '二甲', 'grade_num' => 2, 'class_num' => 1, 'school_id' => 1],
            ['id' => 6, 'title' => '二乙', 'grade_num' => 2, 'class_num' => 2, 'school_id' => 1],
            ['id' => 7, 'title' => '二丙', 'grade_num' => 2, 'class_num' => 3, 'school_id' => 1],
            ['id' => 8, 'title' => '二丁', 'grade_num' => 2, 'class_num' => 4, 'school_id' => 1],
            ['id' => 9, 'title' => '三甲', 'grade_num' => 3, 'class_num' => 1, 'school_id' => 1],
            ['id' => 10, 'title' => '三乙', 'grade_num' => 3, 'class_num' => 2, 'school_id' => 1],
            ['id' => 11, 'title' => '三丙', 'grade_num' => 3, 'class_num' => 3, 'school_id' => 1],
            ['id' => 12, 'title' => '三丁', 'grade_num' => 3, 'class_num' => 4, 'school_id' => 1],
            ['id' => 13, 'title' => '四甲', 'grade_num' => 4, 'class_num' => 1, 'school_id' => 1],
            ['id' => 14, 'title' => '四乙', 'grade_num' => 4, 'class_num' => 2, 'school_id' => 1],
            ['id' => 15, 'title' => '四丙', 'grade_num' => 4, 'class_num' => 3, 'school_id' => 1],
            ['id' => 16, 'title' => '四丁', 'grade_num' => 4, 'class_num' => 4, 'school_id' => 1],
            ['id' => 17, 'title' => '五甲', 'grade_num' => 5, 'class_num' => 1, 'school_id' => 1],
            ['id' => 18, 'title' => '五乙', 'grade_num' => 5, 'class_num' => 2, 'school_id' => 1],
            ['id' => 19, 'title' => '五丙', 'grade_num' => 5, 'class_num' => 3, 'school_id' => 1],
            ['id' => 20, 'title' => '五丁', 'grade_num' => 5, 'class_num' => 4, 'school_id' => 1],
            ['id' => 21, 'title' => '六甲', 'grade_num' => 6, 'class_num' => 1, 'school_id' => 1],
            ['id' => 22, 'title' => '六乙', 'grade_num' => 6, 'class_num' => 2, 'school_id' => 1],
            ['id' => 23, 'title' => '六丙', 'grade_num' => 6, 'class_num' => 3, 'school_id' => 1],
            ['id' => 24, 'title' => '六丁', 'grade_num' => 6, 'class_num' => 4, 'school_id' => 1],

        ]);
    }
}
