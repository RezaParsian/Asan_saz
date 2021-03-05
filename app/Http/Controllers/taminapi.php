<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\Product as ModelsProduct;
use App\Models\Productlog;
use App\Models\remember_token;
use App\Models\User;
use Database\Seeders\product;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class taminapi extends Controller
{
    public function Login(Request $request)
    {
        if (Auth::attempt(['phone' => $request->user, 'password' => $request->password])) {
            $musthash = Auth::user()->id . date("Y-m-d H:i:S") . Auth::user()->roll;
            $remember_token = remember_token::updateOrCreate(["userID" => Auth::user()->id], ["token" => Hash::make($musthash)]);
            return [
                "status" => "true",
                "msg" => "user authentication is valid",
                "user" => Auth::user(),
                "token" => $remember_token->token
            ];
        } else {
            return [
                "status" => "false",
                "msg" => "user or password is incorrect"
            ];
        }
    }

    public function Info(Request $request)
    {
        $time = new Verta();
        $now = $time->formatWord('l ') . $time->format('%d %B %Y');
        $setting = new SettingController;
        return array(
            "setting" => $setting->Fetch(),
            "user" => array_merge($request->user->toArray(), ["address" => $request->user->SingleAddress]),
            "time" => $now,
            "today" => $time->format("%d %B"),
            "tomorrow" => ($time->format("%d") + 1) . " " . $time->format("%B")
        );
    }

    public function Products(Request $request)
    {
        $user = $request->user->toArray();
        return ModelsProduct::where("tuserID", $user['id'])->with("Category")->get();
    }

    public function UpdateProduct(Request $request, ModelsProduct $product)
    {
        if($product->tuserID==$request->user->id){
            $newdata = json_decode($request->getContent(), true);
            Productlog::create([
                "userID"=>$request->user->id,
                "productID"=>$product->id,
                "buyprice_old"=>$product->buyprice,
                "buyprice_new"=>!empty($request->buyprice) ? $request->buyprice : $product->buyprice,
                "price_old"=>$product->price,
                "price_new"=>!empty($request->price) ? $request->price : $product->price,
                "show_old"=>$product->show,
                "show_new"=> !empty($request->show) ? $request->show : $product->show,
            ]);
            $product->update($newdata);
            return $product;
    }else{
            abort(403,"This is not your product");
        }
    }

    public function Factor(Request $request)
    {
        $user = $request->user;
        return Factor::wherehas("Order", function ($query) use ($user) {
            $query->where("tuserID", $user->id)->whereRaw("status in ('waiting','doing','ready','sending')");
        })->with([
            "order" => function ($query) use ($user) {
                $query->where("tuserID", $user->id);
            },"Address","User","Timing","Operator","Peyk"])->orderby("id","asc")->get();
    }

    public function UpdateState(Request $request)
    {
        $user = $request->user;
        $user->update(["state"=>$request->state]);
        $user->Product()->update(["show"=>$request->state=="Out" ? "No" : "Yes"]);
        return [
            "message"=>"وضعیت شما با موفقیت تغیر کرد"
        ];
    }
}
