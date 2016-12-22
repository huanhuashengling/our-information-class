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

            ['title' => 'Administrator', 'slug' => 'admin'],
            ['title' => 'Teacher', 'slug' => 'teach'],
            ['title' => 'Student', 'slug' => 'stude']

        ]);
    }
}
