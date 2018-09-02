<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->delete();

        DB::table('courses')->insert([
            ['id' => 1, 'title' => "xp系统画图"],
            ['id' => 2, 'title' => "win7系统画图"],
            ['id' => 3, 'title' => "键盘侠"],
            ['id' => 4, 'title' => "scratch2.0"],
        ]);
    }
}
