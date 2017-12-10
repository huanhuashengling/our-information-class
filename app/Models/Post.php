<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'students_id', 'lesson_logs_id', 'storage_name', 'original_name', 'file_ext', 'mime_type', 'post_code', 'content'
    ];

    public function hasManyComments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'id');
    }
}
