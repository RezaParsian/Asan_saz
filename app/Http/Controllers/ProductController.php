<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Fetch()
    {
        $product=Product::orderby("olaviyat","ASC")->with("User",function($query){
            $query->select(["id","name","fname","phone"]);
        })->get();
        return $product;
    }
}
