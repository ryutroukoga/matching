<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\In;

class DisplayController extends Controller
{
    //ホーム画面
    public function index()
    {
        $post = new Post;
        $all = $post->all();
        return view('home', [
            'posts' => $all,
        ]);
    }

    //ポスト詳細画面
    public function postall(int $postID)
    {
        $post = Post::findOrFail($postID); // IDが存在しない場合は404を返す
        return view('postdetail', compact('post'));
    }

    //詳細から違反報告
    public function dangerpost(int $postID)
    {
        $post = Post::findOrFail($postID); // IDが存在しない場合は404を返す
        return view('dangerpost', compact('post'));
    }

    //投稿詳細から前画面に戻る
    public function request(int $postID)
    {
        $post = Post::findOrFail($postID); // IDが存在しない場合は404を返す
        return view('requestpost', compact('post'));
    }
    //ユーザー編集から退会画面へ
    public function userdelete1()
    {
        return view('userdelete');
    }
    
    //マイページから依頼投稿画面
    public function requestform()
    {
        return view('requestform');
    }







    //ログイン画面へ
    public function login()
    {
        return view('login');
    }
    //新規登録画面へ
    public function signnew()
    {
        return view('signnew');
    }
    //ログアウト
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function logingo()
    {
        return view('logingo');
    }

}
