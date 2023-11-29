@extends('reservasi.layout')

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

        <h5 class="card-title fw-bolder mb-3">Ubah Data reservasi</h5>

		<form method="post" action="{{ route('reservasi.update', $data->kode_reservasi) }}">
			@csrf
            <div class="mb-3">
                <label for="id_tamu" class="form-label">ID tamu</label>
                <input type="text" class="form-control" id="id_tamu" name="id_tamu" value="{{ $data->id_tamu }}">
            </div>
            <div class="mb-3">
                <label for="id_kamar" class="form-label">ID kamar</label>
                <input type="text" class="form-control" id="id_kamar" name="id_kamar" value="{{ $data->id_kamar }}">
            </div>
			<div class="mb-3">
                <label for="kode_reservasi" class="form-label">Kode reservasi</label>
                <input type="text" class="form-control" id="kode_reservasi" name="kode_reservasi" value="{{ $data->kode_reservasi}}">
            </div>
            <div class="mb-3">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ $data->tanggal_masuk }}">
            </div>
            <div class="mb-3">
                <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar" value="{{ $data->tanggal_keluar }}">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Edit" />
            </div>
			</div>
		</form>
	</div>
</div>

@stop