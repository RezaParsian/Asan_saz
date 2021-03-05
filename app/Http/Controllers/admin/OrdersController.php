<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proeudcts = Product::where([["show", "Yes"]])->get();
        $users = User::where("roll", "Supplier")->get();
        return view("order.new", compact("proeudcts", "users"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "productID" => "required",
            "tuserID" => "required",
            "price" => "required",
            "count" => "required",
            "sumprice" => "required",
        ]);

        Order::create($request->all());

        return back()->with("msg","سفارش شما با موفقت ثبت شد.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $proeudcts = Product::where([["show", "Yes"]])->get();
        $users=$order->Product->action=="one_click" ? Service::where("productID",$order->productID)
        ->wherehas("user",function($query){
            $query->where("roll","Supplier")->wherein("state",["Ready","Working"]);
        })->get()->unique(("userID")) : User::where("roll", "Supplier")->wherein("state",["Ready","Working"])->get();
        return view("order.view", compact("order", "proeudcts", "users"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return back()->with("msg", "سفارش موردنظر با موفقیت ویرایش شد.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return back();
    }
}
