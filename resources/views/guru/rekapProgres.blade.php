<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Progres Siswa</title>
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
    <p style="font-size: 14px; margin-bottom: 10px;"><strong>Nama:</strong> {{ $siswa->nama }}</p>
    <p style="font-size: 14px; margin-bottom: 10px;"><strong>NIS:</strong> {{ $siswa->nik }}</p>
    <p style="font-size: 14px; margin-bottom: 10px;"><strong>Email:</strong> {{ $siswa->email }}</p>    

    <h2>Rekap Tugas</h2>
    <h3>Tugas sudah dikumpulkan:</h3>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Judul Tugas</th>
            <th scope="col">Nilai</th>
          </tr>
        </thead>
        <tbody>
            @foreach($tugasDikumpulkan as $key => $tugas)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $tugas->tugas->judul_tugas }}</td>
                <td>{{ $tugas->nilai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Tugas belum dikumpulkan:</h3>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Judul Tugas</th>
          </tr>
        </thead>
        <tbody>
            @foreach($tugasBelumDikumpulkan as $key => $tugas)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $tugas->judul_tugas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Rekap Kuis</h2>
</body>
</html>
