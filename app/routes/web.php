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
Auth::routes();
// パスワード再設定画面遷移
Route::get('password/reset', [DisplayController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::group(['middleware' => 'auth'], function () {
    // メインページ表示
    Route::get('/', [DisplayController::class, 'home']);
    // プロフィールへ
    Route::get('/profile', [DisplayController::class, 'profile'])->name('profile');
    // ユーザー編集画面・退会へ
    Route::get('/userprofile', [DisplayController::class, 'userprofile'])->name('userprofile');
    // book画面へ
    Route::get('/book', [DisplayController::class, 'book'])->name('book');
    // プロフィール編集画面へ
    Route::get('/profileuser', [DisplayController::class, 'profileuser'])->name('profileuser');
    // 投稿詳細へ
    Route::get('/{reviewdetail}/reviewdetail', [DisplayController::class, 'reviewdetail'])->name('reviewdetail');
    // レビュー削除機能
    Route::post('/{reviewdetail}/reviewdelete', [RegistrationController::class, 'reviewdelete'])->name('delete.review');
    //  レビュー詳細画面へ
    Route::get('/review/{reviewdetail}/detail', [DisplayController::class, 'userreviewdetail'])->name('review_detail');
    // 退会機能
    Route::post('/user/{user}/delete', [RegistrationController::class, 'userdelete'])->name('userdelete');
    // ユーザー編集機能
    Route::post('/user/update', [RegistrationController::class, 'userupdate'])->name('userupdate');
    // プロフィール編集機能
    Route::post('/profile/update', [RegistrationController::class, 'profileupdate'])->name('profileupdate');
    // ナビのメイン
    Route::get('/main', [DisplayController::class, 'home'])->name('mainpage');
    // 検索機能
    Route::get('/search', [RegistrationController::class, 'search'])->name('search');
    // 店舗詳細遷移
    Route::get('/{shopdetail}/shopdetail', [DisplayController::class, 'shopdetail'])->name('shopdetail');
    // 新規レビュー作成遷移
    Route::get('/reviewpost/{shopdetail}/page', [DisplayController::class, 'newreview'])->name('newreview');
    Route::post('/reviewpost/page', [RegistrationController::class, 'post'])->name('post');
});
