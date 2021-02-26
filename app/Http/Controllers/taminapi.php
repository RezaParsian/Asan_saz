<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class taminapi extends Controller
{
    public function Login(Request $request)
    {
        $user = User::where("email",$request->user)->get();
        $a= $user[0]->makeVisible(["password"]);

        if (Hash::check($request->password, $a['password'])) {
            return [
                "status"=>"true",
                "msg"=>"user authentication is valid",
                "user"=>$user->makeHidden(["password"])->first()
            ];
        }else{
            return [
                "status"=>"false",
                "msg"=>"user or password is incorrect"
            ];
        }
    }

    public function Info(Request $request,User $user)
    {
        $time = new Verta();
        $now = $time->formatWord('l ') . $time->format('%d %B %Y');

        $setting = new SettingController;
        return array(
            "setting" => $setting->Fetch(),
            "user" => $user ? array_merge($user->toArray(), ["address" => $user->SingleAddress])  : null,
            "time" => $now,
            "today" => $time->format("%d %B"),
            "tomorrow" => ($time->format("%d") + 1) . " " . $time->format("%B")
        );
    }
}
