<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkViewLog extends Model
{
    protected $fillable = ['students_id', 'works_id', 'guest_students_id'];
}
