<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['title', 'description'];

    public function courses()
    {
        return $this->belongsTo(Course::class, 'courses_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'units_id');
    }
}
