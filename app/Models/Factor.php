<?php

namespace App\Models;

use Hekmatinasser\Verta\Facades\Verta;
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
        "timingID",
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
        "Rddate",
        "status",
        "bale",
    ];

    public function getCreatedAtAttribute()
    {
        return Verta($this->attributes["created_at"])->format("%y/%m/%d");
    }

    public function Address()
    {
        return $this->hasOne(address::class,"id","addressID");
    }

    public function Order()
    {
        return $this->hasMany(Order::class,"factorID","id");
    }
}
