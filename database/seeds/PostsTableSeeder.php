<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();

        for ($i=1; $i <= 7; $i++) {
            \App\Models\Post::create([
                'id' => $i + 1,
                'students_id'   => $i + 3,
                'lesson_logs_id'    => 1,
                'file_path' => "/uploads/12647.png",
                'post_code' => "12647",
                'content' => "asasasasas",
            ]);
        }

        for ($i=1; $i <= 8; $i++) {
            \App\Models\Post::create([
                'students_id'   => $i + 3,
                'lesson_logs_id'    => 2,
                'file_path' => "/uploads/12647.png",
                'post_code' => "12647",
                'content' => "asasasasas",
            ]);
        }

        for ($i=1; $i <= 9; $i++) {
            \App\Models\Post::create([
                'students_id'   => $i + 3,
                'lesson_logs_id'    => 3,
                'file_path' => "/uploads/12647.png",
                'post_code' => "12647",
                'content' => "asasasasas",
            ]);
        }

        for ($i=1; $i <= 9; $i++) {
            \App\Models\Post::create([
                'students_id'   => $i + 3,
                'lesson_logs_id'    => 4,
                'file_path' => "/uploads/12647.png",
                'post_code' => "12647",
                'content' => "asasasasas",
            ]);
        }

        for ($i=1; $i <= 9; $i++) {
            \App\Models\Post::create([
                'students_id'   => $i + 3,
                'lesson_logs_id'    => 5,
                'file_path' => "/uploads/12647.png",
                'post_code' => "12647",
                'content' => "asasasasas",
            ]);
        }
    }
}
