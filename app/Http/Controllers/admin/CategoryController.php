<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::with("sub")->orderby("parent", "asc")->get();
        return view("category.list", compact("categorys"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::with("sub")->whereDoesntHave("sub")->get();
        return view("category.new", compact("categorys"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            "title" => "required|min:2",
            "img" => "max:2048|image",
        ]);

        $imageName = time() . Auth::user()->name . '.' . $request->img->getClientOriginalExtension();
        $request->img->move(public_path('upload/'), $imageName);
        $valid['img'] = $imageName;

        Category::create([
            "parent" => $request->parent,
            "title" => $request->title,
            "img" => $valid['img'],
            "show" => $request->show,
            "olaviyat" => $request->olaviyat,
        ]);

        return back()->with("msg", "دسته بندی با موفقیت ثبت شد.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorys = Category::with("sub")->whereDoesntHave("sub")->get();
        $cat = Category::findOrFail($id);
        return view("category.view", compact("cat", "categorys"));
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
        $cat = Category::findOrFail($id);

        $valid = $request->validate([
            "title" => "required|min:2",
            "img" => "max:2048|image",
        ]);

        if (!empty($request->img) && !empty($cat->img)) {
            unlink(public_path("upload/") . $cat->img);

            $imageName = time() . Auth::user()->name . '.' . $request->img->getClientOriginalExtension();
            $request->img->move(public_path('upload/'), $imageName);
            $request['img'] = $imageName;
        }

        $cat->update($request->except(["_token","_method"]));

        return back()->with("msg", "دسته بندی با موفقیت ویرایش شد.");
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