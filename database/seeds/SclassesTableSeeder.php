<?php

use Illuminate\Database\Seeder;

class SclassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schools')->delete();
        
        // factory('App\Models\Sclass', 3)->create([
        //     'class_num' => 3
        //     ]);
    }
}
