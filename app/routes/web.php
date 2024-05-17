<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;

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
Route::group(['middleware' => 'auth'], function(){
    Route::get('/',[DisplayController::class,'home']);
    Route::get('/main',[DisplayController::class,'home'])->name('mainpage');
    Route::get('/{shopdetail}/shop',[DisplayController::class,'shopdetail'])->name('shopdetail');
});
