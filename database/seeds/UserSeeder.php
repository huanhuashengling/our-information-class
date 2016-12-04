<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        for ($i=0; $i < 10; $i++) {
            \App\User::create([
                'name'   => 'user'.$i,
                'email'    => 'user'.$i.'@163.com',
                'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC',
            ]);
        }
    }
}
