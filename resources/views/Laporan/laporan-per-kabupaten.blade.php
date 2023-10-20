@extends('layouts.index')
@section('content')

<div class="mx-auto text-center">
  <h3>Laporan Penduduk Per Kabupaten</h3>
</div>
<div class="row my-2">
  <div class="col-2">
    <a href="{{url('cetak-laporan-per-kabupaten')}}" class="btn btn-primary rounded-0">Cetak PDF</a>
  </div>
</div>
<table class="table">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Kabupaten</th>
      <th>Nama Provinsi</th>
      <th>Jumlah Penduduk</th>
    </tr>
  </thead>
  <tbody>
    @forelse($kabupatens as $data)
    <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$data->nama ?? '-'}}</td>
      <td>{{$data->provinsi->nama ?? '-'}}</td>
      <td>{{$data->penduduk->count() ?? '-'}} Jiwa</td>
    </tr>
    @empty
    <td colspan="3" class="text-center bg-danger">-- Data Tidak Ada --</td>
    @endforelse
  </tbody>
</table>
<div class="mb-5">
  {{$kabupatens->links('pagination::bootstrap-5')}}
</div>
@endsection