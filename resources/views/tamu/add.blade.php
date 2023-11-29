@extends('tamu.layout')
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
        <h5 class="card-title fw-bolder mb-3">Tambah Tamu</h5>
        <form method="post" action="{{ route('tamu.store') }}">
            @csrf
            <div class="mb-3">
                <label for="id_tamu" class="form-label">ID Tamu</label>
                <input type="text" class="form-control" id="id_tamu" name="id_tamu">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
                <label for="no_telpon" class="form-label">No.Telpon</label>
                <input type="text" class="form-control" id="no_telpon" name="no_telpon">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>
@stop