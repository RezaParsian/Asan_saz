<?php

namespace App\Http\Controllers;

use App\Models\remember_token;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class taminapi extends Controller
{
    public function Login(Request $request)
    {
        if (Auth::attempt(['email' => $request->user, 'password' => $request->password])) {
            $musthash=Auth::user()->id.date("Y-m-d H:i:S").Auth::user()->roll;
            $remember_token=remember_token::updateOrCreate(["userID"=>Auth::user()->id],["token"=>Hash::make($musthash)]);
            return [
                "status" => "true",
                "msg" => "user authentication is valid",
                "user" => Auth::user(),
                "token"=>$remember_token->token
            ];
        } else {
            return [
                "status" => "false",
                "msg" => "user or password is incorrect"
            ];
        }
    }

    public function Info(Request $request)
    {
        $time = new Verta();
        $now = $time->formatWord('l ') . $time->format('%d %B %Y');
        $setting = new SettingController;
        return array(
            "setting" => $setting->Fetch(),
            "user" => array_merge($request->user->toArray(), ["address" => $request->user->SingleAddress]),
            "time" => $now,
            "today" => $time->format("%d %B"),
            "tomorrow" => ($time->format("%d") + 1) . " " . $time->format("%B")
        );
    }
}
