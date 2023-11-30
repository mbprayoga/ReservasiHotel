<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

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


        //$datas = DB::select('SELECT * FROM account WHERE username = ? AND password = ?', [$get_username, $get_password]);
        

        $user = DB::select('SELECT * FROM account WHERE username = ?', [$get_username]);

        // Check if the user exists and verify the password
        if (!empty($user) && Hash::check($get_password, $user[0]->password)) {
            Session::put('user', $user[0]);
            return redirect()->route('home.index')->with('success', 'Welcome!');
        } else {
            return redirect()->route('login.create')->with('danger', 'Failed to Log In!');
        }


        // if(empty($datas))
        // {
        //     return redirect()->route('login.create')->with('danger', 'Failed to Log In!');
        // }  
        // else{
        //     Session::put('user', $datas[0]); // Assuming the first result represents the user data
        //     return redirect()->route('home.index')->with('success', 'Welcome!');
        // }
    }

    public function logout()
    {
        // Clear the user data from the session
        Session::forget('user');

        // Redirect to the login page with a success message
        return redirect()->route('login.create')->with('success', 'Successfully logged out.');
    }
}