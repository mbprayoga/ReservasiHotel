<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function index()
    {
        $datas = DB::table('reservasi')
                ->join('tamu', 'tamu.id_tamu', '=', 'reservasi.id_tamu')
                ->join('kamar', 'kamar.id_kamar', '=', 'reservasi.id_kamar')
                ->get();

        return view('home.index')
            ->with('datas', $datas);
    }
}