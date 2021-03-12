<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class state_logs extends Model
{
    use HasFactory;

    protected $fillable = [
        "userid",
        "state_old",
        "state_new"
    ];
}
