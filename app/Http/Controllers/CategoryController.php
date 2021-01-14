<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Fetch()
    {
        $setting=Category::get();
        return $setting;
    }
}
