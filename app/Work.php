<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    public function hasManyComments()
    {
        return $this->hasMany('App\Comment', 'work_id', 'id');
    }
}
