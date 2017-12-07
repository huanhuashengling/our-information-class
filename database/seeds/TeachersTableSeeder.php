<?php

use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->delete();

        factory('App\Models\Teacher', 2)->create([
            'password' => bcrypt('123456')
            ]);
    }
}
