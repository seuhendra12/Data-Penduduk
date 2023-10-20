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

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <h1>Laporan Jumlah Penduduk per Provinsi</h1>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Provinsi</th>
        <th>Jumlah Penduduk</th>
      </tr>
    </thead>
    <tbody>
      @foreach($provinsis as $provinsi)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $provinsi->nama }}</td>
        <td>{{ $provinsi->penduduk->count() }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
