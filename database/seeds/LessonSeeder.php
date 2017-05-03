<?php

use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->delete();

        DB::table('lessons')->insert([

            ['id' => 1, 'teachers_users_id' => 2, 'title' => '画图工具', 'subtitle' => '曲线画鱼', 'post_file_format' => 'jpg'],
            ['id' => 2, 'teachers_users_id' => 2, 'title' => '幻灯片', 'subtitle' => '自旋图形绘制笑脸', 'post_file_format' => 'jpg'],
            ['id' => 3, 'teachers_users_id' => 2, 'title' => 'Flash', 'subtitle' => 'flash补间动画', 'post_file_format' => 'jpg']

        ]);
    }
}
