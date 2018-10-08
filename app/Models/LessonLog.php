<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonLog extends Model
{
    protected $fillable = [
        'teachers_id', 'sclasses_id', 'lessons_id', 'status', 'rethink', 'ended_at'
    ];
}
