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
        $shops = Shop::with('review')
            ->withCount(['review as average_score' => function ($query) {
                $query->select(DB::raw('coalesce(avg(score),0)'));
            }])->paginate(6);
        return view('main', ['shops' => $shops]);
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
    public function showLinkRequestForm(){
        return view('pas_url');
    }
}
