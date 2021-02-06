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
    public function NewFactor($userid, $dec, $basketprice, $addressid, $rent,$timingID,$Rddate)
    {
        $date=array("Today"=>date("Y-m-d H:i:s"),"Tomorrow"=>date("Y-m-d H:i:s", strtotime('tomorrow')));

        $a = Factor::create([
            "userID" => $userid,
            "ouserID" => -1,
            "tuserID" => -1,
            "puserID" => -1,
            "addressID" => $addressid,
            "timingID" => $timingID,
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
            "Rddate" => $date[$Rddate],
            "status" => "waiting",
            "bale" => "No",
        ]);
        return $a;
    }
}
