<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sclass extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'schools_id', 'enter_school_year', 'class_title', 'class_num', 'is_graduated'
    ];
}
