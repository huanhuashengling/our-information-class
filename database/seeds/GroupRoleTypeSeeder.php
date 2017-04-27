<?php

use Illuminate\Database\Seeder;

class GroupRoleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_role_types')->delete();

        DB::table('group_role_types')->insert([
            ['id' => 1, 'name' => "组长", 'description' => '组长'],
            ['id' => 2, 'name' => "副组长", 'description' => '副组长'],
            ['id' => 3, 'name' => "发言人", 'description' => '发言人'],
            ['id' => 4, 'name' => "组员", 'description' => '组员'],
        ]);
    }
}
