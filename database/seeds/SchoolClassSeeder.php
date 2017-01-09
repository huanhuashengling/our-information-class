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

            ['title' => '一甲', 'grade_num' => 1, 'class_num' => 1],
            ['title' => '一乙', 'grade_num' => 1, 'class_num' => 2],
            ['title' => '一丙', 'grade_num' => 1, 'class_num' => 3],
            ['title' => '一丁', 'grade_num' => 1, 'class_num' => 4],
            ['title' => '二甲', 'grade_num' => 2, 'class_num' => 1],
            ['title' => '二乙', 'grade_num' => 2, 'class_num' => 2],
            ['title' => '二丙', 'grade_num' => 2, 'class_num' => 3],
            ['title' => '二丁', 'grade_num' => 2, 'class_num' => 4],
            ['title' => '三甲', 'grade_num' => 3, 'class_num' => 1],
            ['title' => '三乙', 'grade_num' => 3, 'class_num' => 2],
            ['title' => '三丙', 'grade_num' => 3, 'class_num' => 3],
            ['title' => '三丁', 'grade_num' => 3, 'class_num' => 4],
            ['title' => '四甲', 'grade_num' => 4, 'class_num' => 1],
            ['title' => '四乙', 'grade_num' => 4, 'class_num' => 2],
            ['title' => '四丙', 'grade_num' => 4, 'class_num' => 3],
            ['title' => '四丁', 'grade_num' => 4, 'class_num' => 4],
            ['title' => '五甲', 'grade_num' => 5, 'class_num' => 1],
            ['title' => '五乙', 'grade_num' => 5, 'class_num' => 2],
            ['title' => '五丙', 'grade_num' => 5, 'class_num' => 3],
            ['title' => '五丁', 'grade_num' => 5, 'class_num' => 4],
            ['title' => '六甲', 'grade_num' => 6, 'class_num' => 1],
            ['title' => '六乙', 'grade_num' => 6, 'class_num' => 2],
            ['title' => '六丙', 'grade_num' => 6, 'class_num' => 3],
            ['title' => '六丁', 'grade_num' => 6, 'class_num' => 4],

        ]);
    }
}
