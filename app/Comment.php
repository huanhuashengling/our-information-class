<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['nickname', 'email', 'website', 'content', 'work_id'];

    public function hasOneWork()
    {
        return $this->hasOne('App\Work', 'id', 'work_id');
    }
}
