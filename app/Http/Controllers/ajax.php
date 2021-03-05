<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ajax extends Controller
{
    public function GetCategoryByID($id)
    {
        $result="";
        $categorys = Category::where("parent", $id)->get();

        if (count($categorys)>0) {
            $result = '<ul class="list-group">';
            foreach ($categorys as $cat) {
                $result .= '<li class="list-group-item text-center hand" data-catid="' . $cat->id . '" onclick="ChangeCat(this);MakeBreadcrumb(this)">' . $cat->title . '</li>';
            }
            $result .= '</ul>';
        }

        return $result;
    }

    public function GetCategoryNameByID(Category $id)
    {
        return $id->title;
    }

    public function GetParent($id)
    {
        $result="";
        $categorys=Category::where("parent",$id)->whereDoesntHave("sub")->get();

        if (count($categorys)>0) {
            $result = '<ul class="list-group">';
            foreach ($categorys as $cat) {
                $result .= '<li class="list-group-item text-center hand" data-catid="' . $cat->id . '" onclick="ChangeCat(this);MakeBreadcrumb(this)">' . $cat->title . '</li>';
            }
            $result .= '</ul>';
        }

        return $result;
    }
}
