<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AccountController extends Controller
{
    public function search(Request $request)
    {
        $get_nama = $request->nama;
        $datas = DB::select('
            SELECT *
            FROM account
            WHERE username LIKE :get_nama
        ', ['get_nama' => '%' . $get_nama . '%']);
        return view('account.index')->with('datas', $datas);
    }
    public function index() {
        $datas = DB::select('select * from account');

        return view('account.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('account.add');
    }

    public function store(Request $request)
{
    $request->validate([
        'id' => 'required',
        'username' => 'required',
        'password' => 'required',
    ]);

    $get_username = $request->username;
    $hashedPassword = Hash::make($request->password);

    // Check if the username already exists in the database
    $existingUser = DB::select('SELECT * FROM account WHERE username = ?', [$get_username]);

    if (!empty($existingUser)) {
        return redirect()->route('account.index')->with('success', 'Username telah digunakan');
    }

    // Insert the new account if the username doesn't exist
    DB::insert('INSERT INTO account(username, password) VALUES (:username, :password)',
        [
            'username' => $request->username,
            'password' => $hashedPassword,
        ]
    );

    return redirect()->route('account.index')->with('success', 'Akun berhasil disimpan');
}

    public function edit($id) {
        $data = DB::table('account')->where('id', $id)->first();

        return view('account.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $get_username = $request->username;
        $hashedPassword = Hash::make($request->password);

        // Check if the username already exists in the database
        $existingUser = DB::select('SELECT * FROM account WHERE username = ?', [$get_username]);

        if (!empty($existingUser)) {
            return redirect()->route('account.index')->with('success', 'Username telah digunakan');
        }
        DB::update('UPDATE account SET username = :username, password= :password WHERE id = :id',
        [
            'id' => $id,
            'username' => $request->username,
            'password' => $hashedPassword
        ]
        );
        return redirect()->route('account.index')->with('success', 'Akun berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM account WHERE id = :id', ['id' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('account.index')->with('success', 'Data kamar berhasil dihapus');
    }
}