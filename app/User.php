<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    // 自分の友だちリスト
    function friends()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    // 自分が含まれている友だちリスト
    function oppsite_friends()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }
}
