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

        DB::table('users')->insert([
            ['id' => 1, 'username' => 'admin', 'email' => 'admin@163.com', 'role_id' => 1, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 2, 'username' => 'teacher', 'email' => 'teacher@163.com', 'role_id' => 2, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 3, 'username' => 'student', 'email' => 'student@163.com', 'role_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 4, 'username' => 'student1', 'email' => 'student1@163.com', 'role_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 5, 'username' => 'student2', 'email' => 'student2@163.com', 'role_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 6, 'username' => 'student3', 'email' => 'student3@163.com', 'role_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 7, 'username' => 'student4', 'email' => 'student4@163.com', 'role_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 8, 'username' => 'student5', 'email' => 'student5@163.com', 'role_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 9, 'username' => 'student6', 'email' => 'student6@163.com', 'role_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 10, 'username' => 'student7', 'email' => 'student7@163.com', 'role_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 11, 'username' => 'student8', 'email' => 'student8@163.com', 'role_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 12, 'username' => 'student9', 'email' => 'student9@163.com', 'role_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
        ]);
    }
}
