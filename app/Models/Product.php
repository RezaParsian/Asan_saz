<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "CategoryID",
        "tuserID",
        "title",
        "action",
        "buyprice",
        "price",
        "max",
        "des",
        "img",
        "gallery",
        "show",
        "olaviyat",
        "highrate",
    ];

    protected $table = "product";

    public function Category()
    {
        return $this->hasOne(Category::class, "id", "CategoryID");
    }

    public function User()
    {
        return $this->hasOne(User::class,"id","tuserID");
    }
}
