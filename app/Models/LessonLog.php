<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonLog extends Model
{
    protected $fillable = [
        'teachers_users_id', 'school_classes_id', 'lessons_id', 'status', 'ended_at'
    ];
}
