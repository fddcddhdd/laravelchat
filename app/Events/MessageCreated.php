<?php

namespace App\Events;
use Illuminate\Support\Facades\Auth;
use App\Message;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_name;
    public $message_text;
    public $room_id;


    // Pusherに送る内容
    public function __construct(Message $message)
    {
        // どのチャット・ルームか？
        $this->room_id =  $message->room_id;
        // 発言したユーザID
        $this->user_name = Auth::user()->name;
        // Messageテーブルからテキストだけ
        $this->message_text = $message->text;
    }

    public function broadcastOn()
    {
         return new Channel('my-channel');
        //return new PrivateChannel('App.User.'.$this->user_id);
    }

    public function broadcastAs()
    {
        // イベント名にチャット・ルームIDを付与して、そのチャット・ルームを開いている人(listener)だけに通知する。
        return 'my-event'. $this->room_id;
    }
}
