<?php



Auth::routes();


// ログインしないと見れないページは、このミドルウェア以下にルーティングする。
Route::group(['middleware' => ['auth']], function() {
    Route::get('/', function () {
        return redirect('/room');
    });
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/message/{id}', 'MessageController@index')->name('message.index');
    Route::resource('message', 'MessageController');
    Route::resource('room', 'RoomController');
});

