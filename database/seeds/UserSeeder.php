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
            ['id' => 1, 'username' => 'admin', 'email' => 'admin@163.com', 'roles_id' => 1, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 2, 'username' => 'teacher', 'email' => 'teacher@163.com', 'roles_id' => 2, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 3, 'username' => '刘奥', 'email' => 'student@163.com', 'roles_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 4, 'username' => '欧阳文博', 'email' => 'student1@163.com', 'roles_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 5, 'username' => '李冉希', 'email' => 'student2@163.com', 'roles_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 6, 'username' => '刘希见', 'email' => 'student3@163.com', 'roles_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 7, 'username' => '彭睿宸', 'email' => 'student4@163.com', 'roles_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 8, 'username' => '张可欣', 'email' => 'student5@163.com', 'roles_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 9, 'username' => '王赵悠悠', 'email' => 'student6@163.com', 'roles_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 10, 'username' => '王梓涵', 'email' => 'student7@163.com', 'roles_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 11, 'username' => '刘胜祥', 'email' => 'student8@163.com', 'roles_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
            ['id' => 12, 'username' => '罗一州', 'email' => 'student9@163.com', 'roles_id' => 3, 'password' => '$2y$10$t2mfbPih6j9hrk6c0kX0aujIdre0.lShoBxeoGRiM0X8qcbMqSsKC'],
        ]);
    }
}
