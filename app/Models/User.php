<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'moarefID',
        'regionID',
        'defaultaid',
        'name',
        'fname',
        'email',
        'password',
        'code_meli',
        'birth',
        'last_version',
        'last_order',
        'phone',
        'whatsapp',
        'roll',
        'special',
        'codeposti',
        'sex',
        'pushid',
        'block',
        'taminkind',
        'img ',
        'location',
        'bank',
        'state',
        'vehicle',
        'comision',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Address()
    {
        return $this->hasMany(address::class,"userID","id");
    }

    public function SingleAddress()
    {
        return $this->hasOne(address::class,"id","defaultaid");
    }

    public function Orders()
    {
        return $this->hasMany(Order::class,"tuserID","id");
    }

    public function Product()
    {
        return $this->hasMany(Product::class,"tuserID","id");
    }
}
