<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = ['id'];

    // チャット・ルーム作成者
    function user()
    {
        return $this->belongsTo ('App\User', 'user_id', 'id');
    }

    // このチャット・ルームに属する発言
    function messages()
    {
        return $this->HasMany ('App\Message', 'room_id', 'id');
    }
}
