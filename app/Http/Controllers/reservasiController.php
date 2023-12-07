<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class reservasiController extends Controller
{
    public function search_trash(Request $request)
    {
        $get_nama = $request->nama;
        $datas = DB::select('
            SELECT *
            FROM reservasi
            WHERE deleted_at <> "" AND kode_reservasi LIKE :get_nama
        ', ['get_nama' => '%' . $get_nama . '%']);
        return view('reservasi.trash')
            ->with('datas', $datas);
    }
    public function restore($id)
    {
        DB::update('UPDATE reservasi SET deleted_at = NULL WHERE kode_reservasi = :kode_reservasi', ['kode_reservasi' => $id]);
        return redirect()->route('reservasi.trash')->with('success', 'Data reservasi berhasil restore');
    }
    public function trash()
    {
        $datas = DB::select('select * from reservasi where deleted_at is not null');
        return view('reservasi.trash')
            ->with('datas', $datas);
    }
    public function hide($id)
    {
        DB::update('UPDATE reservasi SET deleted_at=current_timestamp() WHERE kode_reservasi = :kode_reservasi', ['kode_reservasi' => $id]);
        return redirect()->route('reservasi.index')->with('success', 'Data reservasi berhasil dihapus');
    }
    public function search(Request $request)
    {

        $get_nama = $request->nama;
        $datas = DB::select('
            SELECT *
            FROM reservasi
            WHERE deleted_at IS NULL AND kode_reservasi LIKE :get_nama
        ', ['get_nama' => '%' . $get_nama . '%']);
        return view('reservasi.index')->with('datas', $datas);
    }

    public function index()
    {
        $datas = DB::select('select * from reservasi where deleted_at is null');

        return view('reservasi.index')
            ->with('datas', $datas);
    }

    public function create()
    {
        $tamu = DB::select('select * from tamu where deleted_at is null');
        $kamar = DB::select('select * from kamar where deleted_at is null');
        return view('reservasi.add', [
            'tamu'=> $tamu,
            'kamar'=> $kamar
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tamu' => 'required',
            'id_kamar' => 'required',
            'kode_reservasi' => 'required',
            'tanggal_masuk' => 'required',
            'tanggal_keluar' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO reservasi(id_tamu, id_kamar, kode_reservasi, tanggal_masuk, tanggal_keluar) VALUES (:id_tamu, :id_kamar, :kode_reservasi, :tanggal_masuk, :tanggal_keluar)',
            [
                'id_tamu' => $request->id_tamu,
                'id_kamar' => $request->id_kamar,
                'kode_reservasi' => $request->kode_reservasi,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_keluar' => $request->tanggal_keluar,
            ]
        );

        // Menggunakan laravel eloquent
        // Admin::create([
        //     'id_admin' => $request->id_admin,
        //     'id_kamar_admin' => $request->id_kamar_admin,
        //     'alamat' => $request->alamat,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->route('reservasi.index')->with('success', 'Data reservasi berhasil disimpan');
    }

    public function edit($id)
    {
        $data = DB::table('reservasi')->where('kode_reservasi', $id)->first();

        return view('reservasi.edit')->with('data', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'id_tamu' => 'required',
            'id_kamar' => 'required',
            'kode_reservasi' => 'required',
            'tanggal_masuk' => 'required',
            'tanggal_keluar' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE reservasi SET id_tamu = :id_tamu, id_kamar = :id_kamar, kode_reservasi= :kode_reservasi, tanggal_masuk = :tanggal_masuk, tanggal_keluar = :tanggal_keluar WHERE kode_reservasi = :id',
            [
                'id' => $id,
                'id_tamu' => $request->id_tamu,
                'id_kamar' => $request->id_kamar,
                'kode_reservasi' => $request->kode_reservasi,
                'tanggal_masuk' => $request->tanggal_masuk,
                'tanggal_keluar' => $request->tanggal_keluar,
            ]
        );
        return redirect()->route('reservasi.index')->with('success', 'Data reservasi berhasil diubah');
    }

    public function delete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM reservasi WHERE kode_reservasi = :kode_reservasi', ['kode_reservasi' => $id]);

        // Menggunakan laravel eloquent
        // Admin::where('id_admin', $id)->delete();

        return redirect()->route('reservasi.trash')->with('success', 'Data reservasi berhasil dihapus');
    }
}