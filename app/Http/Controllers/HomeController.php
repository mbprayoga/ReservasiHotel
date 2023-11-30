<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{ 
    public function index()
    {
        $datas = DB::select('
            SELECT *
            FROM reservasi
            JOIN tamu ON tamu.id_tamu = reservasi.id_tamu
            JOIN kamar ON kamar.id_kamar = reservasi.id_kamar
        ');

        return view('home.index')
            ->with('datas', $datas);
    }
}