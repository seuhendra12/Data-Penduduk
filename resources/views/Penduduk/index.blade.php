@extends('layouts.index')
@section('content')

<div class="mx-auto text-center">
  <h3>Data Penduduk</h3>
</div>
<div class="my-3">
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
</div>
<div class="row">
  <div class="col-12">
    <a href="{{url('tambah-data')}}" class="btn btn-primary rounded-0">Tambah Data</a>
    <a href="{{url('data-sampah')}}" class="btn btn-danger rounded-0">Sampah</a>
  </div>
</div>
<div class="row mt-3">
  <div class="col-4">
    <form method="GET" action="{{ url('/') }}">
      <div class="input-group mb-3">
        <input type="text" name="search" class="form-control" placeholder="Masukan Nama/NIK">
        <button class="btn btn-outline-secondary" type="submit">Cari</button>
      </div>
    </form>
  </div>
  <div class="col-8">
    <form method="GET" action="{{ url('/') }}">
      <div class="row justify-content-end">
        <div class="col-4">
          <select class="form-select rounded-0" name="provinsi" id="inputProvinsi">
            <option value="">-- Pilih Provinsi --</option>
            @foreach($provinsis as $provinsi)
            <option value="{{$provinsi->id}}">{{$provinsi->nama}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-4">
          <select class="form-select rounded-0" name="kabupaten" id="inputKabupaten">
            <option value="">-- Pilih Kabupaten --</option>
            @foreach($kabupatens as $kabupaten)
            <option value="{{$kabupaten->id}}" data-provinsi="{{$kabupaten->provinsi_id}}">{{$kabupaten->nama}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-2">
          <button class="btn btn-secondary rounded-0">Filter</button>
        </div>
      </div>
    </form>
  </div>
</div>
<table class="table">
  <thead>
    <tr>
      <th>No</th>
      <th>Aksi</th>
      <th>Nama</th>
      <th>NIK</th>
      <th>Tanggal Lahir</th>
      <th>Alamat</th>
      <th>Jenis Kelamin</th>
    </tr>
  </thead>
  <tbody>
    @forelse($penduduks as $data)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>
        <a href="{{url('ubah-data/'.$data->id)}}" class="btn btn-sm btn-success rounded-0 px-3">Edit</a>
        <a href="{{url('hapus-data/'.$data->id)}}" class="btn btn-sm btn-danger rounded-0" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')">Hapus</a>
      </td>
      <td>{{$data->nama ?? '-'}}</td>
      <td>{{$data->nik ?? '-'}}</td>
      <td>{{$data->tanggal_lahir ?? '-'}}</td>
      <td>{{$data->alamat ?? '-'}} Kabupaten {{$data->kabupaten->nama}} Provinsi {{$data->provinsi->nama}}</td>
      <td>
        @if($data->jenis_kelamin == 'L')
        Laki-laki
        @elseif($data->jenis_kelamin == 'P')
        Perempuan
        @endif
      </td>
    </tr>
    @empty
    <td colspan="8" class="text-center bg-danger">-- Data Tidak Ada --</td>
    @endforelse
  </tbody>
</table>
<div class="mb-5">
  {{$penduduks->links('pagination::bootstrap-5')}}
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