<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class kamarController extends Controller
{
    public function search_trash(Request $request)
    {
        $get_nama = $request->nama;
        $datas = DB::table('kamar')->where('deleted_at', '<>', '' )->where('no_kamar', 'LIKE', '%'.$get_nama.'%')->get();
        return view('kamar.trash')
        ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE kamar SET deleted_at = NULL WHERE id_kamar = :id_kamar', ['id_kamar' => $id]);
        return redirect()->route('kamar.trash')->with('success', 'Data kamar berhasil restore');
    }
    public function trash()
    {
        $datas = DB::select('select * from kamar where deleted_at is not null');
        return view('kamar.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        DB::update('UPDATE kamar SET deleted_at=current_timestamp() WHERE id_kamar = :id_kamar', ['id_kamar' => $id]);
        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil dihapus');
    }
    public function search(Request $request)
    {

        $get_nama = $request->nama;
        $datas = DB::table('kamar')->where('deleted_at', NULL )->where('no_kamar', 'LIKE', '%'.$get_nama.'%')->get();
        return view('kamar.index')->with('datas', $datas);
    }
    public function index() {
        $datas = DB::select('select * from kamar where deleted_at is null');

        return view('kamar.index')
            ->with('datas', $datas);
    }

    public function create() {
        return view('kamar.add');
    }

    public function store(Request $request) {
        $request->validate([
            'id_kamar' => 'required',
            'no_kamar' => 'required',
            'tipe' => 'required',
            'harga' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO kamar(id_kamar, no_kamar, tipe, harga) VALUES (:id_kamar, :no_kamar, :tipe, :harga)',
        [
            'id_kamar' => $request->id_kamar,
            'no_kamar' => $request->no_kamar,
            'tipe' => $request->tipe,
            'harga' => $request->harga,
            
        ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'no_kamar_admin' => $request->no_kamar_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil disimpan');
    }

    public function edit($id) {
        $data = DB::table('kamar')->where('id_kamar', $id)->first();

        return view('kamar.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_kamar' => 'required',
            'no_kamar' => 'required',
            'tipe' => 'required',
            'harga' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE kamar SET id_kamar = :id_kamar, no_kamar = :no_kamar, tipe= :tipe, harga = :harga WHERE id_kamar = :id',
        [
            'id' => $id,
            'id_kamar' => $request->id_kamar,
            'no_kamar' => $request->no_kamar,
            'tipe' => $request->tipe,
            'harga' => $request->harga,
        ]
        );
        return redirect()->route('kamar.index')->with('success', 'Data kamar berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM kamar WHERE id_kamar = :id_kamar', ['id_kamar' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('kamar.trash')->with('success', 'Data kamar berhasil dihapus');
    }
}