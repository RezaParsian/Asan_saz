<?php

use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\FactorController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\user;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//$2y$10$fylVBEOWebrdUGnnvcTH5eY2mkzSRBE2ft3L.tXCPYU1c7cLhAj32
Route::get('/', function () {
    return view('welcome');
});

Auth::routes(["register" => false]);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', user::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('factor', FactorController::class);
});
