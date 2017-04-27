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

        for ($i=0; $i < 10; $i++) {
            \App\Models\Post::create([
                'id' => $i,
                'students_users_id'   => 4,
                'lesson_logs_id'    => 1,
                'file_path' => "uploads",
                'post_code' => "123435",
                'content' => "asasasasas",
            ]);
        }
    }
}
