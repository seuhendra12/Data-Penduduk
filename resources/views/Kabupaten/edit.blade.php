@extends('layouts.index')
@section('content')
<div class="mx-auto text-center">
  <h3>Ubah Data Kabupaten</h3>
</div>
<div class="mt-5 container w-75">
  <form action="{{url('/kabupaten/'.$kabupaten->id)}}" method="POST">
    @method('PUT')
    @csrf
    <div class="mb-3 row">
      <label for="inputProvinsi" class="col-sm-3 col-form-label">Provinsi</label>
      <div class="col-sm-9">
        <select class="form-select @error('provinsi') is-invalid @enderror" name="provinsi" id="inputProvinsi">
          <option value="">-- pilih provinsi --</option>
          @foreach($provinsis as $provinsi)
          <option value="{{$provinsi->id}}" {{ old('provinsi', $kabupaten->provinsi_id) == $provinsi->id ? 'selected' : '' }}>{{$provinsi->nama}}</option>
          @endforeach
        </select>
        @error('provinsi')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mb-3 row">
      <label for="inputNama" class="col-sm-3 col-form-label">Nama Kabupaten</label>
      <div class="col-sm-9">
        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="inputNama" name="nama" placeholder="Masukan nama kabupaten" value="{{ old('nama',$kabupaten->nama) }}">
        @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mx-auto text-center mt-3">
      <a href="{{url('kabupaten')}}" class="btn btn-danger rounded-0">Kembali</a>
      <button type="submit" class="btn btn-success rounded-0">Simpan</button>
    </div>
  </form>
</div>
@endsection