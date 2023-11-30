@extends('layout.layout')
@section('content')

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