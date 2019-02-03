<?php

namespace App;
use Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'contact', 'password','address','type','state','city','zipcode','rejected_reason','created_at','updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
