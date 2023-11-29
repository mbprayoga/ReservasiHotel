@extends('reservasi.layout')
@section('content')
<a href="{{ route('home.index') }}" type="button" class="btn btn rounded-3">Home</a>
<a href="{{ route('tamu.index') }}" type="button" class="btn btn rounded-3">Data Tamu</a>
<a href="{{ route('kamar.index') }}" type="button" class="btn btn rounded-3">Data Kamar</a>
<a href="{{ route('reservasi.index') }}" type="button" class="btn btn rounded-3">Data Reservasi</a>
<a href="{{ route('login.create') }}" type="button" class="btn btn-danger rounded-3" style="float:right">Log Out</a>
<div style="margin-top: 15px">
    <div style="margin-bottom: -70px">
        <div style="float:right">
            <a class="btn btn-outline-primary btn-sm" href="{{ route('reservasi.index') }}" type="button">Data Reservasi</a>
            <a class="btn btn-outline-dark btn-sm" href="{{ route('reservasi.trash') }}" type="button">Trash</a>
        </div>
    </div>
</div>
<h4 class="mt-5">Data reservasi</h4>
<a href="{{ route('reservasi.create') }}" type="button" class="btn btn-success rounded-3">Add Data</a>

<div class="form-search" style="float:right">
    <form action="{{ route('reservasi.search') }}" method="get" accept-charset="utf-8">
        <div class="form-group" style="display:flex">
            <input type="search" id="nama" name="nama" class="form-control" placeholder="Cari Kode Reservasi">
            <button type="submit" class="btn btn-secondary">Search</button>
    </form>
</div>
</div>
@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif
<table class="table table-hover mt-2">
    <thead>
        <tr>
            <th>Kode Reservasi</th>
            <th>ID Kamar</th>
            <th>ID Tamu</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->kode_reservasi }}</td>
            <td>{{ $data->id_kamar }}</td>
            <td>{{ $data->id_tamu }}</td>
            <td>{{ $data->tanggal_masuk }}</td>
            <td>{{ $data->tanggal_keluar }}</td>
            <td>
                <a href="{{ route('reservasi.edit', $data->kode_reservasi) }}" type="button"
                    class="btn btn-warning rounded-3">Edit</a>
                <!-- TAMBAHKAN KODE DELETE DIBAWAH BARIS INI -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#hapusModal{{ $data->kode_reservasi }}">
                    Delete
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hapusModal{{ $data->kode_reservasi }}" tabindex="-1"
                    aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Confirm</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('reservasi.hide', $data->kode_reservasi) }}">
                                @csrf
                                <div class="modal-body">
                                    Are you sure to delete this data?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop