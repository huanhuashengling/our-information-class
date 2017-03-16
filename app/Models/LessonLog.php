<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonLog extends Model
{
    protected $fillable = [
        'user_id', 'school_class_id', 'lesson_id', 'ended_at'
    ];
}
