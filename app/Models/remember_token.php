<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class remember_token extends Model
{
    use HasFactory;

    protected $table="remember_token";
    protected $fillable=["userID","token"];

    public function User()
    {
        return $this->hasOne(User::class,"id","userID");
    }
}
