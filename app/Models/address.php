<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    use HasFactory;
    protected $fillable = [
        "userID",
        "regionID",
        "title",
        "address",
        "location",
        "show"
    ];

    public function Region()
    {
        return $this->hasOne(region::class,"id","regionID");
    }
}
