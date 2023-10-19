@extends('layouts.index')
@section('content')
<div class="mx-auto text-center">
  <h3>Ubah Data Penduduk</h3>
</div>
<div class="mt-5 container w-75">
  <form action="{{url('ubah-data/'.$penduduk->id)}}" method="POST">
    @method('PUT')
    @csrf
    <div class="mb-3 row">
      <label for="inputNIK" class="col-sm-2 col-form-label">NIK</label>
      <div class="col-sm-10">
        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="inputNIK" name="nik" placeholder="Masukan nik" value="{{ old('nik',$penduduk->nik) }}">
        @error('nik')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mb-3 row">
      <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
      <div class="col-sm-10">
        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="inputNama" name="nama" placeholder="Masukan nama lengkap" value="{{ old('nama',$penduduk->nama) }}">
        @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mb-3 row">
      <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" id="laki-laki" value="L" {{ $penduduk->jenis_kelamin == 'L' ? 'checked' : '' }}>
          <label class="form-check-label" for="laki-laki">
            Laki-laki
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" id="perempuan" value="P" {{ $penduduk->jenis_kelamin == 'P' ? 'checked' : '' }}>
          <label class="form-check-label" for="perempuan">
            Perempuan
          </label>
        </div>
      </div>
      @error('jenis_kelamin')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3 row">
      <label for="inputTanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
      <div class="col-sm-10">
        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="inputTanggalLahir" name="tanggal_lahir" value="{{ old('tanggal_lahir',$penduduk->tanggal_lahir) }}">
        @error('tanggal_lahir')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mb-3 row">
      <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
      <div class="col-sm-10">
        <textarea name="alamat" id="inputAlamat" cols="20" rows="5" class="form-control @error('alamat') is-invalid @enderror"> {{ old('alamat',$penduduk->alamat) }}</textarea>
        @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mb-3 row">
      <label for="inputProvinsi" class="col-sm-2 col-form-label">Provinsi</label>
      <div class="col-sm-10">
        <select class="form-select @error('provinsi') is-invalid @enderror" name="provinsi" id="inputProvinsi">
          <option value="">-- pilih provinsi --</option>
          @foreach($provinsis as $provinsi)
          <option value="{{$provinsi->id}}" {{ old('provinsi', $penduduk->provinsi_id) == $provinsi->id ? 'selected' : '' }}>{{$provinsi->nama}}</option>
          @endforeach
        </select>
        @error('provinsi')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mb-3 row">
      <label for="inputKabupaten" class="col-sm-2 col-form-label">Kabupaten</label>
      <div class="col-sm-10">
        <select class="form-select @error('kabupaten') is-invalid @enderror" name="kabupaten" id="inputKabupaten">
          <option value="">-- pilih kabupaten --</option>
          @foreach($kabupatens as $kabupaten)
          <option value="{{$kabupaten->id}}" data-provinsi="{{$kabupaten->provinsi_id}}" {{ old('kabupaten', $penduduk->kabupaten_id) == $kabupaten->id ? 'selected' : '' }}>{{$kabupaten->nama}}</option>
          @endforeach
        </select>
        @error('kabupaten')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="mx-auto text-center mt-3">
      <a href="{{url('/')}}" class="btn btn-danger rounded-0">Kembali</a>
      <button type="submit" class="btn btn-success rounded-0">Simpan</button>
    </div>
  </form>
</div>
<script>
  // Menangani perubahan pada dropdown provinsi
  document.getElementById('inputProvinsi').addEventListener('change', function() {
    var selectedProvinsi = this.value;
    var kabupatenDropdown = document.getElementById('inputKabupaten');

    // Menyembunyikan semua opsi kabupaten
    for (var i = 0; i < kabupatenDropdown.options.length; i++) {
      kabupatenDropdown.options[i].style.display = 'none';
    }

    // Menampilkan hanya opsi kabupaten yang sesuai dengan provinsi yang dipilih
    for (var i = 0; i < kabupatenDropdown.options.length; i++) {
      var provinsiId = kabupatenDropdown.options[i].getAttribute('data-provinsi');
      if (provinsiId === selectedProvinsi || selectedProvinsi === '') {
        kabupatenDropdown.options[i].style.display = '';
      }
    }
  });
</script>
@endsection