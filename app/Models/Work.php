<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ['title', 'work_idea', 'description', 'students_id', 'order_num', 'storage_name', 'original_name', 'cover_name', 'mime_type', 'file_ext', 'work_code', 'updated_num', 'is_open'];
}
