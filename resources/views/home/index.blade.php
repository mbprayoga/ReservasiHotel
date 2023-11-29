@extends('home.layout')
@section('content')

<a href="{{ route('home.index') }}" type="button" class="btn btn rounded-3">Home</a>
<a href="{{ route('tamu.index') }}" type="button" class="btn btn rounded-3">Data Tamu</a>
<a href="{{ route('kamar.index') }}" type="button" class="btn btn rounded-3">Data Kamar</a>
<a href="{{ route('reservasi.index') }}" type="button" class="btn btn rounded-3">Data Reservasi</a>
<a href="{{ route('login.create') }}" type="button" class="btn btn-danger rounded-3" style="float:right">Log Out</a>

<h4 class="mt-5">Data Reservasi Hotel</h4>
<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>Kode Reservasi</th>
            <th>Nama Tamu</th>
            <th>No.Kamar</th>
            <th>Harga</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->kode_reservasi }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->id_kamar }}</td>
            <td>{{ $data->harga }}</td>
            <td>{{ $data->tanggal_masuk }}</td>
            <td>{{ $data->tanggal_keluar }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop