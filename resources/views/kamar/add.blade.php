@extends('kamar.layout')
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
        <h5 class="card-title fw-bolder mb-3">Tambah kamar</h5>
        <form method="post" action="{{ route('kamar.store') }}">
            @csrf
            <div class="mb-3">
                <label for="id_kamar" class="form-label">ID kamar</label>
                <input type="text" class="form-control" id="id_kamar" name="id_kamar">
            </div>
            <div class="mb-3">
                <label for="no_kamar" class="form-label">No.Kamar</label>
                <input type="text" class="form-control" id="no_kamar" name="no_kamar">
            </div>
            <div class="mb-3">
                <label for="tipe" class="form-label">Tipe</label>
                <input type="text" class="form-control" id="tipe" name="tipe">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop