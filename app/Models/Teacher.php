<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'teachers';  

    protected $fillable = [
        'username', 'email', 'password', 'schools_id', 'remember_token'
    ];

    protected $hidden = [
        'password','remember_token',
    ];

    public function lesson()
    {
        return $this->hasMany('App\Models\Lesson');
    }
}
