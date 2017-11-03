<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'username', 'email', 'gender', 'sclasses_id', 'level', 'score', 'password', 'groups_id'
        ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
