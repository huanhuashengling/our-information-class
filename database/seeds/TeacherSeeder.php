<?php

use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->delete();

        DB::table('teachers')->insert([
            ['user_id' => 2, 'school_id' => 1],
        ]);
    }
}
