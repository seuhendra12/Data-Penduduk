<!DOCTYPE html>
<html>

<head>
  <title>Laporan Jumlah Penduduk per Provinsi</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h1 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table,
    th,
    td {
      border: 1px solid black;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <h1>Laporan Jumlah Penduduk per Kabupaten</h1>
  <table>
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
      <td colspan="4" class="text-center bg-danger">-- Data Tidak Ada --</td>
      @endforelse
    </tbody>
  </table>
</body>

</html>