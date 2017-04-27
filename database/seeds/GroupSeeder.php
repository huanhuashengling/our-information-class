<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->delete();

        DB::table('groups')->insert([
            ['id' => 1, 'name' => "雄鹰高飞", 'description' => '雄鹰高飞'],
            ['id' => 2, 'name' => "蓝天组", 'description' => '蓝天组'],
        ]);
    }
}
