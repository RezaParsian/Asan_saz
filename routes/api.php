<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SmsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/SendSms', [SmsController::class,"SendSms"])->name("api-sendsms");
Route::post('/MakeUser', [SmsController::class,"MakeUser"])->name("api-makeuser");

Route::post('/Setting', [SettingController::class,"Fetch"])->name("api-fetchsetting");
Route::post('/Product', [ProductController::class,"Fetch"])->name("api-fetchsetting");
Route::get('/Category', [CategoryController::class,"Fetch"])->name("api-fetchsetting");
