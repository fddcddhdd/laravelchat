<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = ['id'];

    // 発言者の名前
    function user()
    {
        return $this->belongsTo ('App\User', 'user_id', 'id');
    }

    // どのチャット・ルームの発言か？
    function room()
    {
        return $this->belongsTo ('App\room', 'room_id', 'id');
    }
}
