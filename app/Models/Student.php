<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['user_id', 'gender', 'school_class_id', 'level', 'score'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}