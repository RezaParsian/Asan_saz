<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\address;
use App\Models\Factor;
use App\Models\Order;
use App\Models\Timing;
use App\Models\User;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;

class CloseFactorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = "%" . $request->q . "%";

        $datebetween = [];
        $start = explode("-", $request->start_date);
        $start = count($start) > 1 ? implode("-", Verta::getGregorian($start[0], $start[1], $start[2])) : date("Y-m-d", strtotime("-365 day"));
        array_push($datebetween, $start);
        $end = explode("-", $request->end_date);
        $end = count($end) > 1 ? implode("-", Verta::getGregorian($end[0], $end[1], $end[2])) : date("Y-m-d", strtotime("+365 day"));
        array_push($datebetween, $end);
        $roll=isset($request->roll) ? "('".$request->roll."')" :"('delivered','canceled user','canceled tuser')";

        $search = [
            "open" => "NOT IN",
            "close" => "IN"
        ];

        $factors = Factor::wherehas("User", function ($query) use ($q) {
            $query->where([
                ["name", "like", $q]
            ])->orwhere([
                ["fname", "like", $q]
            ]);
        })->whereRaw("status " . $search[$request->type ?? "close"] . " $roll")
        ->whereBetween("created_at", $datebetween)
            ->orderby("id", "desc")->orwhere([["id", $request->q]])->paginate(25);

        return view("factor.list", compact("factors"));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Factor $closefactor)
    {
        $users = User::whereRaw("roll in ('Operator','Supplier','Delivery')")->get();
        $address = address::where("userID", $closefactor->userID)->get();
        $timings = Timing::where("type", Verta()->formatWord('l'))->get();
        $orders = Order::where("factorID", $closefactor->id)->get();
        return view("factor.view", compact("closefactor", "users", "address", "timings", "orders"));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
