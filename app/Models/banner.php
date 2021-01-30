<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    use HasFactory;
    protected $table="banner";
    protected $fillable=[
        "BannergpsID",
        "title",
        "show",
        "linkable",
        "link",
        "start_date",
        "end_date",
    ];
}
