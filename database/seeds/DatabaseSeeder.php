<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(AdminsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(SchoolsTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(SclassesTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
        $this->call(LessonLogsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(MarksTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
