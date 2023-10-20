@extends('layouts.index')
@section('content')

<div class="mx-auto text-center">
  <h3>Data Sampah Kabupaten</h3>
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
    <a href="{{url('/kabupaten')}}" class="btn btn-danger rounded-0">Kembali</a>
  </div>
</div>
<table class="table">
  <thead>
    <tr>
      <th>No</th>
      <th>Aksi</th>
      <th>Nama Kabupaten</th>
      <th>Nama Provinsi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($kabupatens as $data)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>
        <a href="{{url('pulih-data-kabupaten/'.$data->id)}}" class="btn btn-sm btn-success rounded-0">Pulihkan</a>
        <a href="{{url('hapus-data-kabupaten-permanen/'.$data->id)}}" class="btn btn-sm btn-danger rounded-0" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini secara permanen?')">Hapus permanen</a>
      </td>
      <td>{{$data->nama ?? '-'}}</td>
      <td>{{$data->provinsi->nama ?? '-'}}</td>
    </tr>
    @empty
    <td colspan="4" class="text-center bg-danger">-- Data Tidak Ada --</td>
    @endforelse
  </tbody>
</table>
<div class="mb-5">
  {{$kabupatens->links('pagination::bootstrap-5')}}
</div>
@endsection