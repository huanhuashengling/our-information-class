<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    public function hasManyComments()
    {
        return $this->hasMany('App\Models\Comment', 'work_id', 'id');
    }
}
