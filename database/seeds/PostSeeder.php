<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();

        for ($i=1; $i <= 5; $i++) {
            \App\Models\Post::create([
                'students_users_id'   => $i + 3,
                'lesson_logs_id'    => 1,
                'file_path' => "uploads",
                'post_code' => "123435",
                'content' => "asasasasas",
            ]);
        }
    }
}
