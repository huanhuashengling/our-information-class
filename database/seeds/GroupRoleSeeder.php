<?php

use Illuminate\Database\Seeder;

class GroupRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_roles')->delete();

        DB::table('group_roles')->insert([
            ['students_users_id' => 3, 'groups_id' => 2, 'group_role_types_id' => 1],
        ]);
    }
}
