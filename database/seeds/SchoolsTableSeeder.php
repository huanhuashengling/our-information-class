<?php

use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schools')->delete();

        DB::table('schools')->insert([
            ['id' => 1, 'title' => '燕山小学', 'district' => '芙蓉区', 'description' => '城区学校'],
        ]);
    }
}
