<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['teachers_users_id', 'title', 'subtitle', 'help_md_doc', 'allow_post_file_types', 'description'];
}
