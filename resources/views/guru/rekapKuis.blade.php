<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Nilai Kuis</title>
    <style>
        body {
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }
        th {
            background-color: #f8f9fa;
            color: #495057;
            padding: 10px;
            text-align: left;
        }
        td {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Rekap Nilai Kuis - {{ $kuis->judul_kuis }}</h2>
    <p>Tanggal Mulai: {{ $kuis->tanggal_mulai }}</p>
    <p>Tanggal Selesai: {{ $kuis->tanggal_selesai }}</p>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nilai Tertinggi</th>
          <th scope="col">Nilai Terendah</th>
          <th scope="col">Nilai Rata-Rata</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ $nilaiTertinggi }}</td>
          <td>{{ $nilaiTerendah }}</td>
          <td>{{ $nilaiRata }}</td>
        </tr>
      </tbody>
   </table>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Siswa</th>
            <th scope="col">NIS</th>
            <th scope="col">Nilai</th>
          </tr>
        </thead>
        <tbody>
            @foreach($pengumpulanKuis as $index => $pengumpulan)
          <tr>
            <th scope="row">{{ $index + 1 }}.</th>
            <td>{{ $pengumpulan->siswa->nama }}</td>
            <td>{{ $pengumpulan->siswa->nik }}</td>
            <td>{{ $pengumpulan->nilai }}</td>
          </tr>
          @endforeach
        </tbody>
    </table>
</body>
</html>
