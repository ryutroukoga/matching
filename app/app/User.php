<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',    
        'email',
        'password',
    ];
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function dangers()
    {
        return $this->hasMany('App\Danger');
    }

    public function applications()
    {
        return $this->hasMany('App\Application');
    }
}
