<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Danger;
use App\Post;
use App\User;
use App\Application;

class RegistrationController extends Controller
{
    //違反報告画面からホーム画面（DB登録）
    public function dangerpost2(Request $request)
    {
        $danger = new Danger;
        $danger->user_id = $request->user_id;
        $danger->post_id = $request->post_id;
        $danger->detail = $request->input('detail', '');
        $danger->save();
        return redirect('/');
    }

    // 入力内容を確認画面に渡す
    public function requestcheck(Request $request)
    {
        $user_id = auth()->user()->id;
        $post_id = $request->input('post_id');
        return view('request', [
            'user_id' => $user_id,
            'post_id' => $post_id,
            'detail' => $request->input('detail'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'DueDate' => $request->input('DueDate'),
        ]);
    }

    //確認画面からホーム画面（DB保存）
    public function request(Request $request)
    {
        $application = new Application;
        $application->user_id = $request->user_id;
        $application->post_id = $request->post_id;
        $application->detail = $request->detail;
        $application->phone = $request->phone;
        $application->email = $request->email;
        $application->DueDate = $request->DueDate;
        $application->save();
        return redirect('/');
    }


    //新規登録確認画面へ遷移
    public function signcheck(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // 画像のパスを保存するための変数を初期化
        $imagePath = null;
        // 画像が送信されているか確認し、存在する場合は保存
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images');
        }
        return view('signup', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'image' => $imagePath, // 確認画面には保存された画像のパスを渡す
        ]);
    }

    //新規登録確認画面からホーム画面（DB保存）
    public function sign(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->image = $request->image;
        $user->save();
        return redirect('/');
    }

    //マイページへ
    public function mypage()
    {
        // ログインしていない場合はログインページにリダイレクト
        if (!Auth::check()) {
            return redirect()->route('logingo');
        }
        $user = Auth::user();
        // stop_flgが1の場合はuserstop画面を表示
        if ($user->stop_flg == 1) {
            return view('userstop');
        }
        $posts = Post::where('user_id', Auth::id())->get();
        // ビューにユーザー情報と投稿データを渡す
        return view('mypage', compact('user', 'posts'));
    }

    // ユーザーの編集・登録画面へ遷移
    public function useredit(Request $request)
    {
        $user = Auth::user();
        return view('useredit', compact('user'));
    }

    // ユーザー情報編集
    public function userupdate(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        // 画像のアップロード処理
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('public/profile_images');
            $user->image = str_replace('public/', 'storage/', $path);
        }
        $user->save();
        return redirect()->route('mypage')->with('user', $user);
    }

    // ユーザー退会
    public function userdelete()
    {
        $user = Auth::user();
        // del_flgを1に設定して論理削除
        $user->del_flg = 1;
        $user->save();
        // ログアウトしてホーム画面にリダイレクト
        Auth::logout();
        return redirect('/');
    }

    //マイページから依頼投稿画面へ
    public function requestform1(Request $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->amount = $request->amount;
        $post->detail = $request->detail;
        $post->image = $request->image;
        // 画像のアップロード処理
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('public/profile_images');
            $post->image = str_replace('public/', 'storage/', $path);
        }
        $post->user_id = Auth::id();
        $post->status = 'uplode';
        $post->save(); // 投稿を保存    
        return redirect('/mypage');
    }

    //投稿詳細・編集
    public function requestformedit($id)
    {
        $post = Post::findOrFail($id);
        return view('requestformedit', compact('post'));
    }

    //編集画面からマイページへ
    public function requestupdate(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        // 画像のアップロード処理
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('public/profile_images');
            $post->image = str_replace('public/', 'storage/', $path);
        }
        // データを保存
        $post->title = $request->input('title', $post->title);
        $post->amount = $request->input('amount', $post->amount);
        $post->detail = $request->input('content', $post->detail);
        $post->status = $request->input('status');
        $post->save();
        return redirect()->route('mypage');
    }

    //管理画面から投稿一覧へ
    public function allpost(Request $request)
    {
        // 投稿と関連ユーザー情報、および違反報告数を一緒に取得
        $posts = Post::with('users')
            ->where('del_flg', 0)
            ->withCount('dangers')
            ->orderByDesc('dangers_count')
            ->paginate(20); // 1ページあたり20件
        return view('allpost', compact('posts'));
    }

    //投稿一覧から投稿詳細画面
    public function kanripostdetail(int $postID)
    {
        $post = Post::findOrFail($postID); // IDが存在しない場合は404を返す
        return view('kanripostdetail', compact('post'));
    }

    ///投稿詳細から投稿表示停止
    public function kanripoststop(int $postID)
    {
        $post = Post::find($postID);
        $post->del_flg = 1;
        $post->save();
        return redirect()->route('allpost');
    }

    // 一覧からユーザー詳細画面
    public function userdetail($userId)
    {
        $users = User::with(['posts' => function ($query) {
            $query->where('del_flg', 0)->withCount('dangers');
        }])->findOrFail($userId);
        return view('userdetail', compact('users'));
    }

    //管理画面からユーザー一覧へ
    public function alluser(Request $request)
    {
        $users = User::where('admins', 0)
            ->where('stop_flg', 0)
            ->withCount([
                'posts as posts_count' => function ($query) {
                    $query->where('del_flg', 0);
                },
                'posts as stopped_posts_count' => function ($query) {
                    $query->where('del_flg', 1);
                }
            ])
            ->orderByDesc('stopped_posts_count')
            ->paginate(10); // 1ページあたり10件
        return view('alluser', compact('users'));
    }

    //ユーザー利用停止
    public function userstop($id)
    {
        $user = User::find($id);
        $user->stop_flg = 1;
        $user->save();
        return redirect()->route('alluser')->with('status', 'ユーザーが停止されました。');
    }

    //検索機能
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $minAmount = $request->input('min_amount');
        $maxAmount = $request->input('max_amount');
        $status = $request->input('status');

        // 検索条件をセッションに保存
        session([
            'search_keyword' => $keyword,
            'search_min_amount' => $minAmount,
            'search_max_amount' => $maxAmount,
            'search_status' => $status
        ]);
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

        // 1ページあたりの件数
        $posts = $query->paginate(4);  
        return view('home', compact('posts'));
    }
}
