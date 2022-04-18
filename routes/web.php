<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MakesController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ToppageController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//これ普通の画面
Route::get('/', [MakesController::class, 'index']);

//登録
Route::post('makes', [MakesController::class, 'store']);

//Makesページからichiranページに移行
Route::get('/makes', [App\Http\Controllers\MakesController::class, 'show']);

//ichiranページの表示
Route::get('/ichiran', [MakesController::class, 'show'])->name('ichiran');


//なぜか２つともないと動かないです・・・
//お気に入り処理
Route::post('make/{make_id}', [MakesController::class, 'favo']);
//favoの登録
Route::post('mypage/{make_id}', [MakesController::class, 'favo']);


//myページの表示
Route::get('/mypage', [MypageController::class, 'index']);


//topページの表示
Route::get('top', [ToppageController::class, 'index'])->name('top');

//詳細ボタン設定(mypage)
Route::get('/shousai/{id}', [MypageController::class, 'shousai'])->name('shousai');
