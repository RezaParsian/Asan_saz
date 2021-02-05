<?php

namespace App\Http\Helper;

use App\Models\address;
use App\Models\Factor;
use App\Models\region;

class Rp76
{
    /**
     * Save a new factor
     * @param get a user id
     * @return row id
     */
    public function NewFactor($userid,$dec,$basketprice,$addressid)
    {
        $address=address::find($addressid);
        $region=region::find($address->id);
        $rent=$region->rent;

        $a = Factor::create([
            "userID" => $userid,
            "ouserID" => -1,
            "tuserID" => -1,
            "puserID" => -1,
            "addressID" => -1,
            "totalprice" => $basketprice,
            "peykprice" => $rent,
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
