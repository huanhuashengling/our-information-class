<?php

use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->delete();

        for ($i=0; $i < 10; $i++) {
            \App\Models\Lesson::create([
                'title'   => 'Title '.$i,
                'subtitle'   => 'Subtitle '.$i,
                'post_file_format'    => 'jpg',
                'creator_id' => 1,
            ]);
        }
    }
}
