<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $factors=Factor::where("Rddate","like","%".date("Y-m-d")."%")->selectraw("status,count(status) as cnt,sum(totalprice) as price")->groupby("status")->get()->each->setAppends([]);
        $users=User::wherein('roll',['Supplier','Delivery','Customer'])->selectraw("roll,count(roll) as cnt")->groupby("roll")->get();
        return view('home',compact("factors","users"));
    }
}
