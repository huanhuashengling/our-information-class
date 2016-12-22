<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function hasManyComments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'id');
    }
}
