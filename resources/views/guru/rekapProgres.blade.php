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

    <h3 style="margin-top: 20px;">Rekap Tugas</h3>
    <h4>Tugas sudah dikumpulkan:</h4>
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
                <th scope="row">{{ $key + 1 }}.</th>
                <td>{{ $tugas->tugas->judul_tugas }}</td>
                <td>{{ $tugas->nilai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Tugas belum dikumpulkan:</h4>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Judul Tugas</th>
          </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($tugasBelumDikumpulkan as $tugas)
            <tr>
                <th scope="row">{{ $no++ }}.</th>
                <td>{{ $tugas->judul_tugas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <h3 style="margin-top: 20px;">B. Rekap Kuis</h3> --}}
</body>
</html>
