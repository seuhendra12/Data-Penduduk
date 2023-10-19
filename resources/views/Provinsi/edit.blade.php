@extends('layouts.index')
@section('content')
<div class="mx-auto text-center">
  <h3>Ubah Data Provinsi</h3>
</div>
<div class="mt-5 container w-75">
  <form action="{{url('provinsi/'.$provinsi->id)}}" method="POST">
    @method('PUT')
    @csrf
    <div class="mb-3 row">
      <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
      <div class="col-sm-10">
        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="inputNama" name="nama" placeholder="Masukan nama provinsi" value="{{ old('nama',$provinsi->nama) }}">
        @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mx-auto text-center mt-3">
      <a href="{{url('provinsi')}}" class="btn btn-danger rounded-0">Kembali</a>
      <button type="submit" class="btn btn-success rounded-0">Simpan</button>
    </div>
  </form>
</div>
@endsection