<?php

namespace App\Http\Controllers;

use App\Http\Helper\Rp76;
use App\Models\Factor;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Factor::where("userID",$request->id)->orderby("id","desc")->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $rp = new Rp76;

        $id = $rp->NewFactor(
            $data["userID"],
            $data["dec"],
            $data["basketprice"],
            $data['addressID'],
            $data['rent'],
            $data['timingID'],
            $data['Rddate']
        )->id;

        $status = "waiting";

        foreach ($data['products'] as $key) {
            unset($key["dec"]);
            $key["factorID"] = $id;
            $key["status"] = $status;
            $key["userID"] = $data["userID"];
            Order::create($key);
        }
        return array(
            "status" => "success",
            "msg" => "سفارشات شما با موفقیت ثبت شدند."
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order)
    {
        return Order::where("factorID",$order)->orderby("id","desc")->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
