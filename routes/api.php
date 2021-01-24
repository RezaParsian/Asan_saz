<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Profile;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SmsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function GuzzleHttp\Promise\settle;

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

Route::group(['prefix' => ''], function () {
    Route::post('/SendSms', [SmsController::class, "SendSms"])->name("api-sendsms");
    Route::post('/MakeUser', [SmsController::class, "MakeUser"])->name("api-makeuser");
});

Route::group(['prefix' => ''], function () {
    Route::post('/Setting', [SettingController::class, "Fetch"])->name("api-fetchsetting");
    Route::post('/Product', [ProductController::class, "Fetch"])->name("api-fetchproduct");
    Route::Post('/Category', [CategoryController::class, "Fetch"])->name("api-fetchscategory");

    Route::match(['get', 'post'], '/AllConfig', function () {
        $setting = new SettingController;
        $product = new ProductController;
        $category = new CategoryController;

        return array("setting" => $setting->Fetch(), "product" => $product->Fetch(), "category" => $category->Fetch());
    })->name("api-fetchsetting");
});

Route::resource("user/profile", Profile::class);
Route::resource('user/address', AddressController::class);
