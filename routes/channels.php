<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// プライベートチャネルには、認証処理が必須！プレフィックス(private-)は自動的に付与されるので不要
Broadcast::channel('my-channel', function () {
    // とりあえず、認証はせずに常にOK
    return true;
});
