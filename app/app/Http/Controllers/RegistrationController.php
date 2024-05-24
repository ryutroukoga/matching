<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateData;
use App\Shop;
use App\Bookmark;
use App\User;
use App\Review;
use App\Violation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class RegistrationController extends Controller
{
    // 部分一致検索機能
    public function search(Request $request)
    {
        $shoping = Shop::with('review');
        $keyword = $request->input('keyword');
        $average_score = $request->input('average_score');
        if (!empty($keyword)) {
            $shoping->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('address', 'LIKE', "%{$keyword}%")
                ->orWhereHas('review', function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', "%{$keyword}%")
                        ->orwhere('comment', 'LIKE', "%{$keyword}%");
                });
        }

        if (!empty($average_score)) {
            $shoping->WhereHas('review', function ($query) use ($average_score) {
                $query->where('score', 'LIKE', "%{$average_score}%");
            });
        }

        $shops = $shoping->withCount(['review as average_score' => function ($query) {
            $query->select(DB::raw('coalesce(avg(score),0)'));
        }])->paginate(6);

        return view('search', [
            'shops' => $shops,
            'keyword' => $keyword,
            'average_score' => $average_score,
        ]);
    }
    // レビュー新規作成機能
    public function post(Request $request)
    {
        $newreview = new Review;
        $newreview->title = $request->title;
        $newreview->comment = $request->comment;
        $newreview->score = $request->score;
        $newreview->shop_id = $request->shop_id;
        $newreview->image = $request->image;
        Auth::user()->reviews()->save($newreview);
        return redirect('/');
    }
    // レビュー削除機能
    public function reviewdelete(Review $reviewdetail)
    {
        $reviewdetail->delete();
        return redirect('profile');
    }
    // ユーザー編集機能
    public function userupdate(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('profile');
    }
    // 退会・ユーザーデータ削除機能
    public function userdelete(User $user)
    {
        $user->delete();
        return redirect('/');
    }
    // パスワード・ユーザー名変更機能
    public function profileupdate(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('profile')->with('success', 'プロフィールが更新されました');
    }
}
