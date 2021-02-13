<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\banner;
use App\Models\Bannergps;
use DateTime;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banners = banner::where([["title", "like", "%" . $request->q . "%"]])->orderby("id", "desc")->paginate(15);
        return view("banner.list", compact("banners"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryes = Bannergps::all();
        return view("banner.new", compact("categoryes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "title" => "required",
                "show" => "required",
                "start_date" => "required|date",
                "end_date" => "required|date|after_or_equal:start_date",
                "link" => "required",
                "BannergpsID" => "required",
                "image" => "required|max:2048|image"
            ]
        );

        $start = explode("/", $request->start_date);
        $end = explode("/", $request->end_date);
        $imageName = time() . Auth::user()->name . "." . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('upload/'), $imageName);

        $request["start_date"] = implode("-", Verta::getGregorian($start[0], $start[1], $start[2]));
        $request["end_date"] = implode("-", Verta::getGregorian($end[0], $end[1], $end[2]));
        $request["img"] = $imageName;

        banner::create($request->except("image"));

        return back()->with("msg", "بنر موردنظر با موفقیت ثبت شد.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(banner $banner)
    {
        $categoryes = Bannergps::all();
        return view("banner.view", compact("banner", "categoryes"));
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
    public function update(Request $request, banner $banner)
    {
        $request->validate(
            [
                "title" => "required",
                "show" => "required",
                "start_date" => "required|date",
                "end_date" => "required|date|after_or_equal:start_date",
                "link" => "required",
                "BannergpsID" => "required",
                "image" => "max:2048|image"
            ]
        );
        $start = str_replace("-", "/", explode(" ", $request->start_date)[0]);
        $end = str_replace("-", "/", explode(" ", $request->end_date)[0]);

        $start = explode("/", $start);
        $end = explode("/", $end);
        $request["start_date"] = implode("-", Verta::getGregorian($start[0], $start[1], $start[2]));
        $request["end_date"] = implode("-", Verta::getGregorian($end[0], $end[1], $end[2]));

        if ($request->hasFile("image")) {
            if (file_exists(public_path('upload/') . $banner->img)) {
                unlink(public_path('upload/') . $banner->img);
            }
            $imageName = time() . Auth::user()->name . "." . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('upload/'), $imageName);
            $request["img"] = $imageName;
        }

        $banner->update($request->except("image"));

        return back()->with("msg", "بنر موردنظر با موفقیت ویرایش شد.");
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
