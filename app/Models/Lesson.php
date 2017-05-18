<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['teachers_users_id', 'title', 'subtitle', 'file_types', 'description'];
}
