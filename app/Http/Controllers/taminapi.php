<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\Order;
use App\Models\Product as ModelsProduct;
use App\Models\Productlog;
use App\Models\remember_token;
use App\Models\state_logs;
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
        if ($product->tuserID == $request->user->id) {
            $newdata = json_decode($request->getContent(), true);
            Productlog::create([
                "userID" => $request->user->id,
                "productID" => $product->id,
                "buyprice_old" => $product->buyprice,
                "buyprice_new" => !empty($request->buyprice) ? $request->buyprice : $product->buyprice,
                "price_old" => $product->price,
                "price_new" => !empty($request->price) ? $request->price : $product->price,
                "show_old" => $product->show,
                "show_new" => !empty($request->show) ? $request->show : $product->show,
            ]);
            $product->update($newdata);
            return $product;
        } else {
            abort(403, "This is not your product");
        }
    }

    public function Factor(Request $request)
    {
        $user = $request->user;
        $result = Factor::wherehas("Order", function ($query) use ($user) {
            $query->where("tuserID", $user->id)->whereRaw("status in ('waiting','doing','ready','sending')");
        })->with([
            "order" => function ($query) use ($user) {
                $query->where("tuserID", $user->id)->whereRaw("status in ('waiting','doing','ready','sending')");
            },
            "user", "timing"
        ])->orderby("Rddate", "asc")->get();

        $newlist = [];

        foreach ($result as $item) {
            $sumprice = 0;
            $sumkala = 0;
            foreach ($item->order as $order) {
                $sumprice += $order->sumprice;
                $sumkala++;
            }
            $a = $item->toArray();
            $a = array_merge($a, ["sumprice" => $sumprice, "sumkala" => $sumkala]);

            array_push($newlist, $a);
        }

        return $newlist;
    }

    // public function Factor(Request $request)
    // {
    //     $user = $request->user;
    //     return Factor::wherehas("Order", function ($query) use ($user) {
    //         $query->where("tuserID", $user->id)->whereRaw("status in ('waiting','doing','ready','sending')");
    //     })->with([
    //         "order" => function ($query) use ($user) {
    //             $query->where("tuserID", $user->id);
    //         },"Address","User","Timing","Operator","Peyk"])->orderby("id","asc")->get();
    // }

    //
    //change status of product and user
    //
    public function UpdateState(Request $request)
    {
        $user = $request->user;
        state_logs::create([
            "userid"=>$user->id,
            "state_old"=>$user->state,
            "state_new"=>$request->state,
        ]);
        $user->update(["state" => $request->state]);
        $user->Product()->update(["show" => $request->state == "Out" ? "No" : "Yes"]);
        return [
            "message" => "وضعیت شما با موفقیت تغیر کرد"
        ];
    }

    public function Rate(Request $request, Factor $factor)
    {
        $factor->update([
            "rate" => $request->rate
        ]);

        return $factor;
    }

    public function FactorDetail(Request $request, $factor)
    {
        $userl = $request->user;
        $result = Factor::where("id", "$factor")
            ->with(["Order"=> function ($query) use($userl){
                $query->where("tuserID", $userl->id);
            }])
            ->get();
        // return $result[0];
        $products = [];
        foreach ($result[0]->Order as $product) {
            array_push($products, [
                "title" => $product->Product->title ?? null,
                "category" => $product->Product->Category->title ?? null,
                "sumprice" => $product->sumprice ?? null,
                "img" => $product->Product->img ?? null,
            ]);
        }

        $user = [
            "name" => $result[0]->User->name ?? null,
            "fname" => $result[0]->User->fname ?? null,
            "phone" => $result[0]->User->phone ?? null,
            "whatsapp" => $result[0]->User->whatsapp ?? null,
            "img" => $result[0]->User->img ?? null,
        ];

        $operator = [
            "name" => $result[0]->Operator->name ?? null,
            "fname" => $result[0]->Operator->fname ?? null,
            "phone" => $result[0]->Operator->phone ?? null,
            "whatsapp" => $result[0]->Operator->whatsapp ?? null,
            "img" => $result[0]->Operator->img ?? null,
        ];

        $tamin = [
            "name" => $userl->name ?? null,
            "fname" => $userl->fname ?? null,
            "phone" => $userl->phone ?? null,
            "whatsapp" => $userl->whatsapp ?? null,
            "img" => $userl->img ?? null,
        ];

        $peyk = [
            "name" => $result[0]->peyk->name ?? null,
            "fname" => $result[0]->peyk->fname ?? null,
            "phone" => $result[0]->peyk->phone ?? null,
            "whatsapp" => $result[0]->peyk->whatsapp ?? null,
            "img" => $result[0]->peyk->img ?? null,
        ];

        $address = $result[0]->Address;
        $timing = $result[0]->Timing;

        $result = $result[0]->toArray();

        $result = array_merge($result, [
            "products" => $products,
            "user" => $user,
            "operator" => $operator,
            "taminkonande" => $tamin,
            "peyk" => $peyk,
            "address" => $address,
            "timing" => $timing,
        ]);

        return $result;
    }

    public function Doing(Request $request, Factor $factor)
    {
        $user = $request->user;

        $factor->update([
            "status" => "doing",
        ]);

        Order::where([
            ["factorID", $factor->id],
            ["tuserID", $user->id],
        ])->update([
            "status" => "doing"
        ]);

        return [
            "msg" => "وضعیت با موفقیت تغیر یافت."
        ];
    }

    public function OrderStatus(Request $request, Factor $factor)
    {
        $user = $request->user;

        Order::where([
            ["factorID", $factor->id],
            ["tuserID", $user->id],
        ])->update([
            "status" => $request->status
        ]);

        $fk = Order::where([
            ["factorID", $factor->id],
            ["status", "!=", $request->status]
        ])->get()->count();

        if ($fk == 0) {
            $factor->update([
                "status" => $request->status
            ]);
        }

        return [
            "msg" => "وضعیت با موفقیت تغیر یافت."
        ];
    }
}
