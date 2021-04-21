<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $myId = Auth::id();
        // $myAccount = User::find($myId);
        $myAccount = Auth::user();


        // 一覧表示用にフォローワーを自分をフォローしてくれた順で表示
        $accounts_follower = User::find($myId)->show_follower_activity()->get();

        // ここのidentify_idはdetails.blade.phpに移動した時のbackとかに必要　⇦　これはもう要らないコントローラを細かく分けたから
        // 　　でもまだ identify_idは必要である、follow_lists.invokeで必要だから。
        $identify_id = 'activity';

        return view('myService.activity')->with([
            'accounts_follower' => $accounts_follower,
            // ↓ それぞれのアカウントが自分がフォローしているかどうかを調べるfollow_checkで使う
            'myAccount' => $myAccount,
            'identify_id' => $identify_id,
            // ↓ フォローされた時間を表示する時にfollowテーブルの自分と相手のレコードを指定する時に使う
            // created_atを取得
            // 'myId' => $myId,
        ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {
        //
        $identify_id = 'activity';
        $user_id = $user->id;

        $myId = Auth::id();
        // $myAccount = User::find($myId);
        $myAccount = Auth::user();


        // どの人の詳細を表示させるかをuser_idで受け取ってその人をフォローしているかを
        $follow_check = $myAccount->show_follow()->where('receive_user_id', $user_id)->first();
        
        // どの人の詳細を表示させるかをuser_idで受け取ってその人のアカウントを取得
        $hisAccount = User::find($user_id);

      
        return view('myService.details')->with([
            'identify_id' => $identify_id,
            'hisAccount' => $hisAccount,
            'follow_check' => $follow_check,
        ]);
    }

}
