@extends('layouts.index')
@section('content')

<div class="mx-auto text-center">
  <h3>Data Kabupaten</h3>
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
    <a href="{{url('kabupaten/create')}}" class="btn btn-primary rounded-0">Tambah Data</a>
    <a href="{{url('sampah-kabupaten')}}" class="btn btn-danger rounded-0">Sampah</a>
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
        <a href="{{url('kabupaten/'.$data->id.'/edit')}}" class="btn btn-sm btn-success rounded-0 px-3">Edit</a>
        <a href="{{ url('kabupaten/'. $data->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $data->id }}').submit();" class="btn btn-sm btn-danger rounded-0" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')">Hapus</a>

        <form id="delete-form-{{ $data->id }}" action="{{ url('kabupaten/'. $data->id) }}" method="POST" style="display: none;">
          @csrf
          @method('DELETE')
        </form>
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