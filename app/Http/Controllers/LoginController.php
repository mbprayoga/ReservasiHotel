<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function create()
    {
        return view('login.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $get_username = $request->username;
        $get_password = $request->password;

        //$datas = DB::table('admin')->where('username', 'LIKE', $get_username, 'AND', 'password', 'LIKE', $get_password)->first();
        //$datas = DB::table('admin')->where('username', '=', $get_username, 'AND', 'password', '=', $get_password)->first();
        $usr = DB::table('account')->where('username', '=', $get_username)->first();
        $pas = DB::table('account')->where('password', '=', $get_password)->first();

        if(is_null($usr) or is_null($pas))
        {
            return redirect()->route('login.create')->with('danger', 'Failed to Log In!');
        }  
        else{
            return redirect()->route('home.index')->with('success', 'Welcome!');
        }
    }
}