<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupRole extends Model
{
    protected $fillable = ['students_users_id', 'groups_id', 'group_roles_types_id'];
}
