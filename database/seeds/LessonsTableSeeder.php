<?php

use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder
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

            ['id' => 1, 'teachers_id' => 2, 'title' => '画图工具', 'subtitle' => '曲线画鱼', 'help_md_doc' => '##我是帮助文档##', 'allow_post_file_types' => 'jpg'],
            ['id' => 2, 'teachers_id' => 2, 'title' => '幻灯片', 'subtitle' => '自旋图形绘制笑脸', 'help_md_doc' => '##我是帮助文档##', 'allow_post_file_types' => 'jpg'],
            ['id' => 3, 'teachers_id' => 2, 'title' => 'Flash', 'subtitle' => 'flash补间动画', 'help_md_doc' => '##我是帮助文档##', 'allow_post_file_types' => 'jpg'],
            ['id' => 4, 'teachers_id' => 2, 'title' => 'PowerPoint', 'subtitle' => '自定义动画', 'help_md_doc' => '##我是帮助文档##', 'allow_post_file_types' => 'jpg'],
            ['id' => 5, 'teachers_id' => 2, 'title' => '电子表格', 'subtitle' => '纪录生活中的电器', 'help_md_doc' => '##我是帮助文档##', 'allow_post_file_types' => 'jpg'],

        ]);
    }
}
