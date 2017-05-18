<?php

use Illuminate\Database\Seeder;

class FileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('file_types')->delete();

        DB::table('file_types')->insert([
            ['id' => 1, 'file_type_label' => "jpg"],
            ['id' => 2, 'file_type_label' => "png"],
            ['id' => 3, 'file_type_label' => "bmp"],
            ['id' => 4, 'file_type_label' => "gif"],
            ['id' => 5, 'file_type_label' => "doc"],
            ['id' => 6, 'file_type_label' => "docx"],
            ['id' => 7, 'file_type_label' => "ppt"],
            ['id' => 8, 'file_type_label' => "pptx"],
            ['id' => 9, 'file_type_label' => "xls"],
            ['id' => 10, 'file_type_label' => "xlsx"],
        ]);
    }
}
