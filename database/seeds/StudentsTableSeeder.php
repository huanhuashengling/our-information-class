<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete();

        // factory('App\Models\Student', 60)->create([
        //     'password' => bcrypt('123456')
        //     ]);
    }
}
