<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'teachers_id', 'title', 'subtitle', 'help_md_doc', 'allow_post_file_types', 'description', 'lesson_code'
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'units_id');
    }
}
