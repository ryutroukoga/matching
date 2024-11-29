<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\In;

class DisplayController extends Controller
{
    public function index()
    {
        $post = new Post;
        $all = $post->where('del_flg', 0)->take(8)->get();
        // ログインしているか確認
        if (!auth()->check()) {
            // ログインしていない場合はホーム画面を表示
            return view('home', [
                'posts' => $all,
            ]);
        }
        //stop_flgが1ならユーザー利用停止画面
        if (auth()->user()->stop_flg == 1) {
            return view('userstop');
            //adminsが1なら管理者画面
        } else if (auth()->user()->admins == 1) {
            return view('kanri', [
                'posts' => $all,
            ]);
            // adminsが0なら一般ユーザー画面
        } else if (auth()->user()->admins == 0) {
            return view('home', [
                'posts' => $all,
            ]);
        }
    }

    //無限スクロール
    public function loadMorePosts(Request $request)
    {
        $page = $request->get('page', 1);
        // 1ページあたりの表示件数
        $perPage = 4;
        // セッションから検索条件を取得
        $keyword = session('search_keyword');
        $minAmount = session('search_min_amount');
        $maxAmount = session('search_max_amount');
        $status = session('search_status');

        $query = Post::query();
        
        // キーワード検索
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('detail', 'like', '%' . $keyword . '%');
            });
        }

        // 金額の範囲指定
        if ($minAmount !== null && $minAmount !== '') {
            $query->where('amount', '>=', (int)$minAmount);
        }
        if ($maxAmount !== null && $maxAmount !== '') {
            $query->where('amount', '<=', (int)$maxAmount);
        }
        
        // ステータスの絞り込み
        if ($status) {
            $query->where('status', $status);
        }
        
        // 投稿をページごとに取得
        $posts = $query->paginate($perPage, ['*'], 'page', $page);
        
        // 取得した投稿があれば、HTML部分を生成
        $hasMore = $posts->hasMorePages();  // 次のページがあるかどうかをチェック
        
        return response()->json([
            'posts' => view('partials.post-list', compact('posts'))->render(),
            'hasMore' => $hasMore
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

    //詳細から申請入力画面
    public function request(int $postID)
    {
        $post = Post::findOrFail($postID); // IDが存在しない場合は404を返す
        $user_id = auth()->id();
        return view('requestpost', compact('post', 'user_id'));
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

    //ログイン誘導
    public function logingo()
    {
        return view('logingo');
    }
    
}
