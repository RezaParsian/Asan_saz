<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable=[
        "productID"
    ];
    
    public function User()
    {
        return $this->hasOne(User::class,"id","userID");
    }
}
