<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class tamuController extends Controller
{
    public function search_trash(Request $request)
    {
        $get_nama = $request->nama_tamu;
        $datas = DB::table('tamu')->where('deleted_at', '<>', '' )->where('nama', 'LIKE', '%'.$get_nama.'%')->get();
        return view('tamu.trash')
        ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE tamu SET deleted_at = NULL WHERE id_tamu = :id_tamu', ['id_tamu' => $id]);
        return redirect()->route('tamu.trash')->with('success', 'Data tamu berhasil restore');
    }
    public function trash()
    {
        $datas = DB::select('select * from tamu where deleted_at is not null');
        return view('tamu.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        DB::update('UPDATE tamu SET deleted_at=current_timestamp() WHERE id_tamu = :id_tamu', ['id_tamu' => $id]);
        return redirect()->route('tamu.index')->with('success', 'Data tamu berhasil dihapus');
    }
    public function search(Request $request)
    {

        $get_nama = $request->nama;
        $datas = DB::table('tamu')->where('deleted_at', NULL )->where('nama', 'LIKE', '%'.$get_nama.'%')->get();
        return view('tamu.index')->with('datas', $datas);
    } 
    public function index() {
        $datas = DB::select('select * from tamu  where deleted_at is null');

        return view('tamu.index')
            ->with('datas', $datas);
    }
    public function create() {
        return view('tamu.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_tamu' => 'required',
            'nama' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO tamu(id_tamu, nama, no_telpon, email) VALUES (:id_tamu, :nama, :no_telpon, :email)',
        [
            'id_tamu' => $request->id_tamu,
            'nama' => $request->nama,
            'no_telpon' => $request->no_telpon,
            'email' => $request->email,
            
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'nama_admin' => $request->nama_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('tamu.index')->with('success', 'Data tamu berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('tamu')->where('id_tamu', $id)->first();

        return view('tamu.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_tamu' => 'required',
            'nama' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE tamu SET id_tamu = :id_tamu, nama = :nama, no_telpon= :no_telpon, email = :email WHERE id_tamu = :id',
        [
            'id' => $id,
            'id_tamu' => $request->id_tamu,
            'nama' => $request->nama,
            'no_telpon' => $request->no_telpon,
            'email' => $request->email,
        ]
        );
        return redirect()->route('tamu.index')->with('success', 'Data tamu berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM tamu WHERE id_tamu = :id_tamu', ['id_tamu' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('tamu.trash')->with('success', 'Data tamu berhasil dihapus');
    }
}