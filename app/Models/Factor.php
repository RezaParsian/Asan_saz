<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    use HasFactory;
    protected $fillable = [
        "userID",
        "ouserID",
        "tuserID",
        "puserID",
        "addressID",
        "totalprice",
        "peykprice",
        "comision",
        "recive",
        "userdes",
        "operatordes",
        "rate",
        "peykrate",
        "peykratedes",
        "peykrecive",
        "delevry",
        "status",
        "bale",
    ];
}
