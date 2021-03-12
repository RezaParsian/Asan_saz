<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use Illuminate\Http\Request;

class operator extends Controller
{
    public function Factor(Request $request)
    {
        $user = $request->user;
        $result = Factor::wherehas("Order", function ($query) use ($user) {
            $query->where("ouserID", $user->id)->orwhere("ouserID", -1)->whereRaw("status in ('waiting','doing','ready','sending')");
        })->with([
            "order" => function ($query) use ($user) {
                $query->whereRaw("status in ('waiting','doing','ready','sending')");
            },
            "user", "timing"
        ])->orderby("Rddate", "asc")->get();

        $newlist = [];

        foreach ($result as $item) {
            $sumprice = 0;
            $sumkala = 0;
            foreach ($item->order as $order) {
                $sumprice += $order->sumprice;
                $sumkala += $order->count;
            }
            $a = $item->toArray();
            $a = array_merge($a, ["sumprice" => $sumprice, "sumkala" => $sumkala]);

            array_push($newlist, $a);
        }

        return $newlist;
    }

    public function GetFactor(Request $request, Factor $factor)
    {
        $user = $request->user;
        $result = [
            "msg" => "سفارش برای اپراتور دیگری ثبت شده است."
        ];

        if (in_array($factor->ouserID, [-1, $user->id])) {
            $result = [
                "msg" => "سفارش برای شما ثبت شد."
            ];
            $factor->update([
                "ouserID" => $user->id
            ]);
        }
        return $result;
    }

    public function FactorDetail(Request $request, $factor)
    {
        $userl = $request->user;
        $result = Factor::where("id", "$factor")
            ->with("Order.TaminKonande")
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
            "name" => $result[0]->name ?? null,
            "fname" => $result[0]->fname ?? null,
            "phone" => $result[0]->phone ?? null,
            "whatsapp" => $result[0]->whatsapp ?? null,
            "img" => $result[0]->img ?? null,
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
            "peyk" => $peyk,
            "address" => $address,
            "timing" => $timing,
        ]);

        return $result;
    }

    public function PeykRate(Request $request, Factor $factor)
    {
        $factor->update([
            "peykrate" => $request->peykrate,
            "peykratedes"=>$request->peykratedes
        ]);

        return $factor;
    }

    public function OperatorDes(Request $request,Factor $factor)
    {
        $factor->update([
            "operatordes"=>$request->operatordes
        ]);

        return $factor;
    }

    public function FactorStatus(Request $request,Factor $factor)
    {
        $factor->update([
            "status"=>$request->status
        ]);

        return $factor;
    }

    public function PayDetail(Request $request,Factor $factor)
    {
        $factor->update([
            "totalprice"=>$request->totalprice,
            "comision"=>$request->comision,
            "recive"=>$request->recive
        ]);

        return $factor;
    }
}
