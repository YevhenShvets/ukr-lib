<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\DataBase;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mypage(Request $request)
    {
        $user_id = $request->user()->id;
        $liked = DataBase::selectLikedTexts($user_id);

        $history = DataBase::selectHistory($user_id);

        return view('user.mypage', ['liked' => $liked, 'history' => $history]);
    }

    public function dislikeTextMy(Request $request)
    {
        $user_id = $request->user()->id;
        $id = $request->input('id_text');
        DataBase::deleteUserTextList($id, $user_id);
        

        return redirect()->route('mypage');
    } 

    public function adminClearHistory(Request $request){
        $user_id = $request->input('user_id');
        DataBase::clearHistory($user_id);

        return redirect()->route('mypage');
    }

    public function adminDeleteHistory(Request $request, $id){
        $user_id = $request->user()->id;
        DataBase::deleteHistory($user_id, $id);

        return redirect()->route('mypage');
    }
}
