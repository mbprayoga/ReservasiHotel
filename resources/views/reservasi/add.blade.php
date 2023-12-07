@extends('layout.layout')
@section('content')
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title fw-bolder mb-3">Tambah Reservasi</h5>
        <form method="post" action="{{ route('reservasi.store') }}">
            @csrf
            <div class="mb-3">
                <label for="tamu" class="form-label">Tamu</label>
                <select class="form-select" aria-label="Default select example" name="id_tamu">
                    <option selected>Pilih Tamu</option>
                    @foreach ($tamu as $data)
                        <option value={{$data->id_tamu}}>{{ $data->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="kamar" class="form-label">Kamar</label>
                <select class="form-select" aria-label="Default select example" name="id_kamar" >
                    <option selected>Pilih Kamar</option>
                    @foreach ($kamar as $data)
                        <option value={{$data->id_kamar}}>{{ $data->tipe }} no. {{ $data->no_kamar }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="kode_reservasi" class="form-label">Kode Reservasi</label>
                <input type="text" class="form-control" id="kode_reservasi" name="kode_reservasi">
            </div>
            <div class="mb-3">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
            </div>
            <div class="mb-3">
                <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop