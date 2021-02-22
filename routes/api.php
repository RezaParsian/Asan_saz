<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminstuffController;
use App\Http\Controllers\ajax;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Profile;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\TimingController;
use App\Http\Helper\Rp76;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use Hekmatinasser\Verta\Verta;
use PhpParser\Node\Stmt\Return_;
use PHPUnit\TextUI\XmlConfiguration\Group;

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
        $time = new Verta();
        $now = $time->formatWord('l ') . $time->format('%d %B %Y');
        $id=Request()->id ?? 0;
        $user=User::where("id",$id)->with("address",function($query) use($id){
            return $query->where("id",$id);
        })->first();

        $setting = new SettingController;
        $product = new ProductController;
        $category = new CategoryController;
        $banner = new BannerController;

        return array(
            "setting" => $setting->Fetch(),
            "product" => $product->Fetch(),
            "category" => $category->Fetch(),
            "banner" => $banner->index(),
            "user"=>$user ? $user->only("name","fname","phone","state","address") : null,
            "time" => $now,
            "today" => $time->format("%d %B"),
            "tomorrow" => ($time->format("%d") + 1) . " " . $time->format("%B")
        );
    })->name("api-fetchsetting");
});

Route::resource("user/profile", Profile::class);
Route::resource('user/address', AddressController::class);
Route::resource('region', RegionController::class);
Route::resource('banner', BannerController::class);
Route::resource('timings', TimingController::class);
Route::resource('order', OrderController::class);
Route::resource('admin', AdminstuffController::class);

Route::group(['prefix' => 'ajax'], function () {
    Route::get('/{id}', [ajax::class, "GetCategoryByID"]);
    Route::get('/name/{id}', [ajax::class, "GetCategoryNameByID"]);
});
