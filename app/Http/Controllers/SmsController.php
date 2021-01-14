<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    public function SendSms(Request $request)
    {
        $randomcode = rand(10000, 99999);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env("smspanel"),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "receptor=" . $request->phone . "&type=1&template=" . env("smstemplate") . "&param1=$randomcode",
            CURLOPT_HTTPHEADER => array(
                'apikey: zd0q89vHvKix04izLh7hVAp5QwPZus6DQJ6VmEkh+JY'
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response, true);

        if ($result['result'] == "success") {
            return array("status" => "success", "code" => $randomcode);
        } else {
            return array("status" => "failed");
        }
    }
    public function MakeUser(Request $request)
    {
        $isUser=User::where("phone",$request->phone)->count();

        if($isUser>0){
            return array(
                "status"=>"failed",
                "message"=>"شما قبلا ثبت نام کرده اید."
            );
        }

        $user = User::create([
            "name" => $request->name,
            "phone" => $request->phone,
            "whatsapp" => $request->phone,
        ]);
        $user["status"] = "success";
        return $user;
    }
}