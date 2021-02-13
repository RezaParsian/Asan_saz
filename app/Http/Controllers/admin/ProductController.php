<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::where([
            ["title", "like", "%" . $request->q . "%"],
            ["highrate", "like", "%" . $request->special . "%"]
        ])->orderby("CategoryID", "asc")->orderby("olaviyat", "asc")->paginate(25);

        if ($products->currentPage() > $products->lastPage()) {
            return redirect(route("product.index") . "/?page=" . $products->lastPage());
        }

        return view("product.list", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where("roll", "Supplier")->get();
        return view("product.new", compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gallery = [];

        $val = $request->validate([
            "CategoryID" => "required",
            "tuserID" => "required|min:1",
            "title" => "required",
            "des" => "required",
            "buyprice" => "required",
            "price" => "required",
            "img" => "required|max:2048|image",
            "gallery.*" => "max:2048|image"
        ]);

        $imageName = time() . Auth::user()->name . "." . $request->img->getClientOriginalExtension();
        $request->img->move(public_path('upload/'), $imageName);

        if ($request->hasFile('gallery')) {
            for ($i = 0; $i < count($request->gallery); $i++) {
                $imageName = time() . Auth::user()->name . "$i." . $request->gallery[$i]->getClientOriginalExtension();
                $request->gallery[$i]->move(public_path('upload/'), $imageName);
                array_push($gallery, $imageName);
            }
        }

        Product::create([
            "CategoryID" => $request->CategoryID,
            "tuserID" => $request->tuserID,
            "title" => $request->title,
            "action" => $request->action,
            "buyprice" => $request->buyprice,
            "price" => $request->price,
            "max" => $request->max,
            "des" => $request->des,
            "img" => $imageName,
            "gallery" => json_encode($gallery),
            "show" => $request->show,
            "olaviyat" => $request->olaviyat,
            "highrate" => $request->highrate,
        ]);
        return back()->with("msg", "محصول مودنظر با موفقیت ثبت شد.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $users = User::where("roll", "Supplier")->get();
        return view("product.view", compact("product", "users"));
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
    public function update(Request $request, Product $product)
    {
        $gallery = [];
        $val = $request->validate([
            "CategoryID" => "required",
            "tuserID" => "required",
            "title" => "required",
            "des" => "required",
            "buyprice" => "required",
            "price" => "required",
        ]);

        $update = [
            "CategoryID" => $request->CategoryID,
            "tuserID" => $request->tuserID,
            "title" => $request->title,
            "action" => $request->action,
            "buyprice" => $request->buyprice,
            "price" => $request->price,
            "max" => $request->max,
            "des" => $request->des,
            "show" => $request->show,
            "olaviyat" => $request->olaviyat,
            "highrate" => $request->highrate,
        ];

        if ($request->hasFile("img")) {

            if (file_exists(public_path('upload/' . $product->img))) {
                unlink(public_path('upload/' . $product->img));
            }

            $imageName = time() . Auth::user()->name . "." . $request->img->getClientOriginalExtension();
            $request->img->move(public_path('upload/'), $imageName);
            $update["img"] = $imageName;
        }

        if ($request->hasFile('gallery')) {
            $i = 0;
            foreach ($request->gallery as $img) {
                $imageName = time() . Auth::user()->name . "$i." . $img->getClientOriginalExtension();
                $img->move(public_path('upload/'), $imageName);
                array_push($gallery, $imageName);
                $i++;
            }
            $update["gallery"] = json_encode($gallery);

            $gl = json_decode($product->gallery) ?? [];

            foreach ($gl as $item) {
                if (file_exists(public_path('upload/' . $item))) {
                    unlink(public_path('upload/' . $item));
                }
            }
        }

        $product->update($update);
        return back()->with("msg", "محصول موردنظر با موفقیت ویرایش شد.");
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
