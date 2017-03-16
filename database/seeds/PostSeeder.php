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
                'title'   => 'Title '.$i,
                'body'    => 'Body '.$i,
                'user_id' => 3,
            ]);
        }
    }
}
