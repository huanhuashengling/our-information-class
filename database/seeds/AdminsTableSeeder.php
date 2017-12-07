<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete();
        
        factory('App\Models\Admin', 3)->create([
            'password' => bcrypt('123456')
            ]);
    }
}
