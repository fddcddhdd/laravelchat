<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 友達リスト
        $friends = Auth::User()->friends()->get();
        // 自分が友達リストに含まれている人も追加する(mergeだと重複を削除してくれる。concatだと重複のまま存在する)
        $friends = $friends->merge(Auth::User()->oppsite_friends()->get());



        //return view('home', compact('friends'));
        return view('room.index');
    }
}
