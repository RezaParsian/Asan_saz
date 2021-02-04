<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "productID",
        "tuserID",
        "userID",
        "factorID",
        "count",
        "price",
        "sumprice",
        "status",
    ];
}
