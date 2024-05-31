<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\Bookmark;
use App\User;
use App\Review;
use App\Violation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class DisplayController extends Controller
{
    // メインページ表示
    public function home()
    {
        $user = Auth::user();
        if ($user && $user->stop_flg == 1) {
            Auth::logout();
            return redirect()->route('user.stop');
        }
        if ($user && $user->role == 2) {
            return redirect()->route('shop.main');
        }
        if ($user && $user->role == 1) {
            return redirect()->route('manager');
        } else {
            $reviews = Review::with('shop')->where('del_flg', 0)->orderBy('created_at', 'desc')->paginate(6);
            return view('main', ['reviews' => $reviews]);
        }
    }

    // プロフィール画面遷移
    public function profile()
    {
        $review = Auth::user()->reviews()->get();
        $reviews = $review->paginate(5);

        return view('profile', ['reviews' => $reviews]);
    }
    // 店舗詳細に遷移　店舗の詳細＆店舗に向けられたレビュー表示
    public function shopdetail(Shop $shopdetail)
    {
        // 店舗に関連付けられたレビューを取得し、del_flg が 0 のものに絞り込む
        $reviews = Review::where('shop_id', $shopdetail->id)
            ->where('del_flg', 0)
            ->get();

        // 平均スコアを計算する
        $averageScore = Review::where('shop_id', $shopdetail->id)
            ->where('del_flg', 0)
            ->avg('score');

        return view('shop_detail', [
            'detail' => $shopdetail,
            'reviews' => $reviews,
            'averageScore' => $averageScore
        ]);
    }
    // 別ユーザーのレビュー詳細画面
    public function userreviewdetail(Review $reviewdetail)
    {
        $user = $reviewdetail->user()->first();
        return view('review_detail', [
            'review' => $reviewdetail,
            'user' => $user,
        ]);
    }
    // 新規レビュー作成画面遷移
    public function newreview(Shop $shopdetail)
    {
        return view('newpost', ['details' => $shopdetail]);
    }
    // ユーザー編集・退会画面へ
    public function userprofile()
    {
        // $users = Auth::user()->get();
        return view('user');
    }
    // プロフィール編集画面遷移
    public function profileuser()
    {
        return view('profile_edit');
    }
    // book画面遷移
    public function book()
    {
        return view('book');
    }
    // 自分の投稿画面
    public function reviewdetail(Review $reviewdetail)
    {
        return view('user_reviewdetail', ['detail' => $reviewdetail]);
    }
    // パスワード再設定リンク送信画面遷移
    public function showLinkRequestForm()
    {
        return view('pas_url');
    }
    // 利用停止画面
    public function userstop()
    {
        return view('stop');
    }
    // 違反報告画面
    public function violation(Review $reviewdetail)
    {
        return view('violation', ['detail' => $reviewdetail]);
    }

    // ---------------------------------------------------------------------------
    // 店舗アカウント登録画面
    public function shoplogin()
    {
        return view('shop_user');
    }
    // shopメイン表示
    public function shophome()
    {
        return view('shop_main');
    }
    // 店舗新規追加画面
    public function newshop()
    {
        return view('shop_post');
    }
    // 自店舗レビュー一覧
    public function shopreview()
    {
        $user = Auth::user();
        $shopId = $user->shops()->pluck('id')->first();

        // 自店舗に関連するレビューを取得
        $reviews = Review::where('shop_id', $shopId)
            ->where('del_flg', 0)
            ->paginate(10);

        return view('shop_review', [
            'reviews' => $reviews,
        ]);
    }

    // 自店舗レビュー詳細画面
    public function myshopreviewdetail(Review $reviewdetail)
    {
        $user = $reviewdetail->user()->first();
        return view('myshopreview_detail', [
            'review' => $reviewdetail,
            'user' => $user,
        ]);
    }
    // 違反報告画面遷移
    public function shopviolation(Review $reviewdetail)
    {
        return view('shop_violation', ['detail' => $reviewdetail]);
    }
    // ---------------------------------------------------------------------------
    //   管理者
    public function managermain()
    {
        return view('manager');
    }
    // ユーザーリストへ
    public function userlist()
    {
        $users = User::where('role', 0)->withCount(['reviews' => function ($query) {
            $query->where('del_flg', 1);
        }])->orderBy('reviews_count', 'desc')
            ->paginate(10);
        return view('user_list', ['users' => $users]);
    }

    // レビューリストへ
    public function reviewlist()
    {
        $reviews = Review::withCount('violations')
            ->orderBy('violations_count', 'desc')
            ->paginate(20);
        return view('review_list', ['reviews' => $reviews]);
    }
}
