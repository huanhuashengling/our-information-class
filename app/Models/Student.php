<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Student extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    
    protected $fillable = [
        'username', 'email', 'gender', 'sclasses_id', 'level', 'score', 'password', 'groups_id', 'remember_token', 'is_lock'
        ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
