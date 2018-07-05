<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table = 'terms'; 

    protected $fillable = [
        'from_date', 'to_date', 'is_current', 'enter_school_year', 'grade_key', 'term_segment'
    ];
}
