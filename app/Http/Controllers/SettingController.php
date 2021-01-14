<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function Fetch()
    {
        $setting=Setting::get();
        return $setting;
    }
}
