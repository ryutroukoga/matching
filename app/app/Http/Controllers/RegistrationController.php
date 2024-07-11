<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateData;
use App\Shop;
use App\Bookmark;
use App\Http\Requests\CreatePass;
use App\Http\Requests\CreateProfile;
use App\Http\Requests\CreateReview;
use App\Http\Requests\CreateShop;
use App\Http\Requests\Createshoprule;
use App\Http\Requests\CreateUser;
use App\User;
use App\Review;
use App\Violation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class RegistrationController extends Controller
{
    // 部分一致検索機能
    public function search(Request $request)
    {
        $shoping = Review::with('shop');
        $keyword = $request->input('keyword');
        $average_score = $request->input('average_score');
        // タイトル、コメント、住所
        if (!empty($keyword) && !empty($average_score)) {
            // 両方の条件を満たす場合
            $shoping->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', "%{$keyword}%")
                    ->orWhere('comment', 'LIKE', "%{$keyword}%")
                    ->orWhereHas('shop', function ($query) use ($keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    });
            })->where('score', 'LIKE', "%{$average_score}%");
        } elseif (!empty($keyword)) {
            // キーワードのみの場合
            $shoping->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', "%{$keyword}%")
                    ->orWhere('comment', 'LIKE', "%{$keyword}%")
                    ->orWhereHas('shop', function ($query) use ($keyword) {
                        $query->where('address', 'LIKE', "%{$keyword}%");
                    });
            });
        } elseif (!empty($average_score)) {
            // 点数のみの場合
            $shoping->where('score', 'LIKE', "%{$average_score}%");
        }
        // 作成が新しい順
        $shops = $shoping->where('del_flg', 0)->orderBy('created_at', 'desc')->paginate(6);

        return view('search', [
            'shops' => $shops,
            'keyword' => $keyword,
            'average_score' => $average_score,
        ]);
    }
    // レビュー新規作成機能
    public function post(CreateReview $request)
    {
        $newreview = new Review;
        $newreview->title = $request->title;
        $newreview->comment = $request->comment;
        $newreview->score = $request->score;
        $newreview->shop_id = $request->shop_id;

        if ($request->hasFile('formfile')) {
            $imagePath = $request->file('formfile')->store('shops', 'public');
            $newreview->image = $imagePath;
        }

        Auth::user()->reviews()->save($newreview);
        return redirect()->route('shopdetail', ['shopdetail' => $request->shop_id]);
    }
    // レビュー削除機能
    public function reviewdelete(Review $reviewdetail)
    {
        $reviewdetail->delete();
        return redirect('profile');
    }
    // レビュー編集機能
    public function reviewupdate(Review $reviewdetail, CreateReview $request)
    {
        $columns = ['title', 'score', 'comment'];

        foreach ($columns as $column) {
            $reviewdetail->$column = $request->$column;
        }
        if ($request->hasFile('formfile')) {
            $imagePath = $request->file('formfile')->store('shops', 'public');
            $reviewdetail->image = $imagePath;
        }

        Auth::user()->reviews()->save($reviewdetail);
        return redirect('profile');
    }
    // ユーザー編集機能
    public function userupdate(CreateProfile $request)
    {
        $user = Auth::user();
        $user->email = $request->email;
        $user->save();
        return redirect('profile')->with('success', 'プロフィールが更新されました');
    }
    // 退会・ユーザーデータ削除機能
    public function userdelete(User $user)
    {
        $user->delete();
        return redirect('/');
    }
    // パスワード・ユーザー名変更機能
    public function profileupdate(CreatePass $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('profile')->with('success', 'プロフィールが更新されました');
    }
    // 新規登録＆内容確認画面
    public function logincon(CreateUser $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        $user->save();

        return view('signup_con', ['user' => $user]);
    }
    // ---------------------------------------------------------------------------
    // 店舗アカウント登録＆内容確認画面
    public function shoplogincon(CreateUser $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        $user->role = 2;
        $user->save();

        return view('shop_usercon', ['user' => $user]);
    }
    // 店舗新規登録
    public function postshop(CreateShop $request)
    {
        // ログインしているユーザーのIDを取得
        $userId = Auth::id();
        $imagePath = $request->file('formfile')->store('shops', 'public');

        $shop = new Shop;
        $shop->name = $request->name;
        $shop->comment = $request->comment;
        $shop->address = $request->address;
        $shop->image = $imagePath;
        $shop->user_id = $userId;
        $shop->save();

        // リダイレクト
        return redirect()->route('shop.main');
    }
    // 店舗編集
    public function shopupdate(Shop $shopdetail, Createshoprule $request)
    {
        $columns = ['name', 'address', 'comment'];

        foreach ($columns as $column) {
            $shopdetail->$column = $request->$column;
        }
        if ($request->hasFile('formfile')) {
            $imagePath = $request->file('formfile')->store('shops', 'public');
            $shopdetail->image = $imagePath;
        }

        Auth::user()->shops()->save($shopdetail);
        return redirect('/');
    }
    // 違反報告
    public function violationreport(Request $request)
    {
        $violation = new Violation;
        $violation->comment = $request->comment;
        $violation->review_id = $request->review_id;
        $violation->user_id = $request->user_id;
        $violation->save();
        if ($request->user()->role == 0) {
            return redirect()->route('shopdetail', ['shopdetail' => $request->shop_id]);
        } else {
        
            return redirect()->route('shop.review', ['shopdetail' => $request->shop_id]);
        }
    }
    // ユーザーの利用停止
    public function userdown(User $user)
    {
        $user->stop_flg = 1;
        $user->save();
        return redirect()->back();
    }
    // ユーザーの利用再開
    public function userup(User $user)
    {
        $user->stop_flg = 0;
        $user->save();
        return redirect()->back();
    }
    // レビュー非表示機能
    public function reviewhide(Review $reviewdetail)
    {
        $reviewdetail->del_flg = 1;
        $reviewdetail->save();
        // レビューを投稿したユーザーのdisplayカラムの値を増加させる
        $user = $reviewdetail->user;
        $user->increment('display');

        return redirect()->back();
    }
    // レビュー再表示機能
    public function reviewopen(Review $reviewdetail)
    {
        $reviewdetail->del_flg = 0;
        $reviewdetail->save();
        $user = $reviewdetail->user;
        $user->decrement('display');

        return redirect()->back();
    }
    // ブックマーク機能
    public function ajaxlike(Request $request)
    {
        $user_id = Auth::id();
        $review_id = $request->review_id;
        $bookmark = Bookmark::where('user_id', $user_id)->where('review_id', $review_id)->first();

        if ($bookmark) {
            $bookmark->delete();
            $bookmarked = false;
        } else {
            Bookmark::create([
                'user_id' => $user_id,
                'review_id' => $review_id,
            ]);
            $bookmarked = true;
        }

        return response()->json(['bookmarked' => $bookmarked]);
    }
}
