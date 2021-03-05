<?php

namespace App\Models;

use Facade\Ignition\Tabs\Tab;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productlog extends Model
{
    use HasFactory;
    protected $table="product_logs";

    protected $fillable = [
        "userID",
        "productID",
        "buyprice_old",
        "buyprice_new",
        "price_old",
        "price_new",
        "show_old",
        "show_new"
    ];

}
