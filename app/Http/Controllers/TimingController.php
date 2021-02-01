<?php

namespace App\Http\Controllers;

use App\Models\Timing;
use Illuminate\Http\Request;

class TimingController extends Controller
{
    private $today,$tomorrow;
    private $days = [
        "شنبه",
        "یکشنبه",
        "دوشنبه",
        "سه شنبه",
        "چهار شنبه",
        "پنج شنبه",
        "جمعه",
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->today = verta()->formatWord('l');
        $dayid=array_search($this->today,$this->days)<=5  ? array_search($this->today,$this->days)+1 : 0;
        $this->tomorrow=$this->days[$dayid];
    }

    public function index()
    {
        return Timing::where(
            [
                ["show", "=", "Yes"],
                ["type", "=", $this->today],
                ["fromdate", "<", verta()->format("h")],
                ["todate", ">", verta()->format("h")],
            ]
        )->orwhere("title", "فوری")->orwhere("type",$this->tomorrow)->get();
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
     * @param  \App\Models\Timing  $timing
     * @return \Illuminate\Http\Response
     */
    public function show(Timing $timing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timing  $timing
     * @return \Illuminate\Http\Response
     */
    public function edit(Timing $timing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timing  $timing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timing $timing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timing  $timing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timing $timing)
    {
        //
    }
}
