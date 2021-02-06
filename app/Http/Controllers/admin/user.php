<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\region;
use App\Models\User as ModelsUser;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class user extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = ModelsUser::where([
            ["name", "like", "%" . $request->q . "%"]
        ])->orwhere([
            ["fname", "like", "%" . $request->q . "%"]
        ])->orwhere([
            ["phone", "like", "%" . $request->q . "%"]
        ])->orwhere([
            ["code_meli", "like", "%" . $request->q . "%"]
        ])->orderby("id", "desc")->paginate(25);

        if ($users->currentPage() > $users->lastPage()) {
            return redirect(route("user.index") . "/?page=" . $users->lastPage());
        }

        return view("user.list", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = ModelsUser::get();
        $regions = region::get();
        return view("user.new", compact("users", "regions"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => "required|min:3",
            "fname" => "required|min:3",
            "code_meli" => "required|min:10",
            "phone" => "required|min:11",
        ]);

        $request["password"] = Hash::make($request->password);

        ModelsUser::create($request->all());
        return back()->with("msg", "کاربر با موفقیت ثبت شد.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = ModelsUser::findOrFail($id);
        $regions = region::get();

        return view("user.view", compact("user", "regions"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=ModelsUser::findOrFail($id);

        $validate = $request->validate([
            "name" => "required|min:3",
            "fname" => "required|min:3",
            "code_meli" => "required|min:10",
            "phone" => "required|min:11",
        ]);

        if (!empty($request->password)) {
            $request["password"] = Hash::make($request->password);
        } else {
            unset($request->password);
        }
        $user->update($request->all());

        return back()->with("msg","کاربر با موفقیت ویرایش شد.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
