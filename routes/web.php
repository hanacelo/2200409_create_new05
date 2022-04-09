<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MakesController;//追記

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

//お気に入り処理
Route::post('make/{make_id}', [MakesController::class, 'favo']);

