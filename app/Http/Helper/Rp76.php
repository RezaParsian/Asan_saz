<?php

namespace App\Http\Helper;

use App\Models\Factor;

class Rp76
{
    /**
     * Save a new factor
     * @param get a user id
     * @return row id
     */
    public function NewFactor($userid,$dec)
    {
        $a = Factor::create([
            "userID" => $userid,
            "ouserID" => -1,
            "tuserID" => -1,
            "puserID" => -1,
            "addressID" => -1,
            "totalprice" => null,
            "peykprice" => null,
            "comision" => null,
            "recive" => null,
            "userdes" => $dec,
            "operatordes" => null,
            "rate" => null,
            "peykrate" => null,
            "peykratedes" => null,
            "peykrecive" => null,
            "delevry" => null,
            "status" => "waiting",
            "bale" => "No",
        ]);
        return $a;
    }
}
