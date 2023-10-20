<div class="bg-dark">
  <header class="d-flex justify-content-center py-3">
    <ul class="nav nav-pills">
      <li class="nav-item"><a href="{{url('/')}}" class="nav-link">Penduduk</a></li>
      <li class="nav-item"><a href="{{url('/provinsi')}}" class="nav-link">Provinsi</a></li>
      <li class="nav-item"><a href="{{url('/kabupaten')}}" class="nav-link">Kabupaten</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Laporan
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{url('/laporan/provinsi')}}">Laporan per Provinsi</a>
          <a class="dropdown-item" href="{{url('/laporan/kabupaten')}}">Laporan per Kabupaten</a>
        </div>
      </li>
    </ul>
  </header>
</div>
