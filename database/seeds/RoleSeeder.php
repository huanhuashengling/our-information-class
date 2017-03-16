<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        DB::table('roles')->insert([

            ['id' => 1, 'title' => 'Administrator', 'slug' => 'admin'],
            ['id' => 2, 'title' => 'Teacher', 'slug' => 'teach'],
            ['id' => 3, 'title' => 'Student', 'slug' => 'stude']

        ]);
    }
}
