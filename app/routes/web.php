<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Mail;
use App\mail\TestEmail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);
// 一般ユーザログイン内容確認画面
Route::post('/login/confilm', [RegistrationController::class, 'logincon'])->name('login.con');
// ショップユーザログイン内容確認画面
Route::get('/login/shop', [DisplayController::class, 'shoplogin'])->name('shop.login');
Route::post('/shop/login/confilm', [RegistrationController::class, 'shoplogincon'])->name('shop.logincon');
// パスワード再設定画面遷移
Route::get('password/reset', [DisplayController::class, 'showLinkRequestForm'])->name('password.request');
// パスワードリンク送信
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// 利用停止画面
Route::get('/user/stop', [DisplayController::class, 'userstop'])->name('user.stop');
// -----------------------------------------------------------------------------------------------------------------------
// メインページ表示
Route::get('/', [DisplayController::class, 'home']);
// 他ユーザーの詳細画面
Route::get('/review/{reviewdetail}/detail', [DisplayController::class, 'userreviewdetail'])->name('review_detail');
// 店舗詳細遷移
Route::get('/{shopdetail}/shopdetail', [DisplayController::class, 'shopdetail'])->name('shopdetail');
// 検索機能
Route::get('/search', [RegistrationController::class, 'search'])->name('search');
// ナビのメイン
Route::get('/main', [DisplayController::class, 'home'])->name('mainpage');

Route::group(['middleware' => 'auth'], function () {
    // shopメインへ
    Route::get('/shop/main', [DisplayController::class, 'shophome'])->name('shop.main');
    // 管理者ユーザー画面
    Route::get('/manager/main', [DisplayController::class, 'managermain'])->name('manager');
    // プロフィールへ
    Route::get('/profile', [DisplayController::class, 'profile'])->name('profile');
    // ユーザー編集画面・退会へ
    Route::get('/userprofile', [DisplayController::class, 'userprofile'])->name('userprofile');
    // book画面へ
    Route::get('/book', [DisplayController::class, 'book'])->name('book');
    // プロフィール編集画面へ
    Route::get('/profileuser', [DisplayController::class, 'profileuser'])->name('profileuser');
    // 違反報告画面へ　ユーザー機能
    Route::get('user/violation/{reviewdetail}/page', [DisplayController::class, 'violation'])->name('violation');
    // 違反報告画面へ　店舗機能
    Route::get('shop/violation/{reviewdetail}/page', [DisplayController::class, 'shopviolation'])->name('shop.violation');

    Route::group(['middleware' => 'can:view,reviewdetail'], function () {
        // 自分の投稿詳細へ
        Route::get('/{reviewdetail}/reviewdetail', [DisplayController::class, 'reviewdetail'])->name('reviewdetail');
        // レビュー削除機能
        Route::post('/{reviewdetail}/reviewdelete', [RegistrationController::class, 'reviewdelete'])->name('delete.review');
        // レビュー編集画面へ
        Route::get('update/{reviewdetail}/display', [DisplayController::class, 'update'])->name('update');
        Route::post('update/{reviewdetail}/review', [RegistrationController::class, 'reviewupdate'])->name('update.review');
    });

    Route::group(['middleware' => 'can:view,user'], function () {
        // 退会機能
        Route::post('/user/{user}/delete', [RegistrationController::class, 'userdelete'])->name('userdelete');
        // 利用停止機能
        Route::post('/user/{user}/down', [RegistrationController::class, 'userdown'])->name('user.down');
        // 利用再開機能
        Route::post('/user/{user}/up', [RegistrationController::class, 'userup'])->name('user.up');
    });
    // レビュー非表示機能
    Route::post('review/{reviewdetail}/hide', [RegistrationController::class, 'reviewhide'])->name('hide.review');
    // レビュー再表示
    Route::post('review/{reviewdetail}/open', [RegistrationController::class, 'reviewopen'])->name('open.review');
    // 店舗ユーザーのレビュー詳細画面
    Route::get('/review/{reviewdetail}/detail/myshop', [DisplayController::class, 'myshopreviewdetail'])->name('myshopreviewdetail');
    // 新規レビュー作成遷移
    Route::get('/reviewpost/{shopdetail}/page', [DisplayController::class, 'newreview'])->name('newreview');
    // 新規レビュー作成
    Route::post('/reviewpost/page', [RegistrationController::class, 'post'])->name('post');
    // ユーザー編集機能
    Route::post('/user/update', [RegistrationController::class, 'userupdate'])->name('userupdate');
    // プロフィール編集機能
    Route::post('/profile/update', [RegistrationController::class, 'profileupdate'])->name('profileupdate');
    // 新規店舗登録画面へ
    Route::get('/shoppost/page', [DisplayController::class, 'newshop'])->name('shop.post');
    // 自店舗レビュー一覧へ
    Route::get('myshop/review/page', [DisplayController::class, 'shopreview'])->name('shop.review');
    // 自店舗編集画面へ
    Route::get('myshop/update/page', [DisplayController::class, 'shopupdate'])->name('shop.update');
    // 自店舗編集
    Route::post('update/{shopdetail}/shop', [RegistrationController::class, 'shopupdate'])->name('update.shop');
    // 新店舗登録
    Route::post('shop/pist/page', [RegistrationController::class, 'postshop'])->name('newshop.post');
    // ユーザーリストへ
    Route::get('user/list/page', [DisplayController::class, 'userlist'])->name('user.list');
    // レビューリストへ
    Route::get('review/list/page', [DisplayController::class, 'reviewlist'])->name('review.list');
    // 違反報告機能
    Route::post('/violation/report/page', [RegistrationController::class, 'violationreport'])->name('violation.report');
    // ブックマーク機能    
    Route::post('/ajaxlike', [RegistrationController::class, 'ajaxLike'])->name('ajaxlike');
    Route::get('/getBookmarkStatus', [RegistrationController::class, 'BookmarkStatus'])->name('BookmarkStatus');
});
