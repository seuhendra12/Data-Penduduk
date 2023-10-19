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
  <div class="col-4">
    <a href="{{url('/')}}" class="btn btn-danger rounded-0">Kembali</a>
  </div>
</div>
<table class="table mt-3">
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
        <a href="{{url('pulih-data/'.$data->id)}}" class="btn btn-sm btn-success rounded-0">Pulihkan</a>
        <a href="{{url('hapus-data-permanen/'.$data->id)}}" class="btn btn-sm btn-danger rounded-0" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini secara permanen?')">Hapus permanen</a>
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
@endsection