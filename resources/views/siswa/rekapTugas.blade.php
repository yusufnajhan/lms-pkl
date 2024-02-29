<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Nilai Tugas dan Kuis Kelas {{ $kelas->mata_pelajaran }} {{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</title>
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
    <body>
        <h3>Rekap Tugas Kelas {{ $kelas->mata_pelajaran }} {{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</h3>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Tugas</th>
                <th scope="col">Nilai</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($tugass as $index => $tugas)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $tugas->judul_tugas }}</td>
                    @foreach ($tugas->pengumpulanTugas as $pengumpulan)
                    <td>{{ $pengumpulan->nilai }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <h3>Rekap Kuis Kelas {{ $kelas->mata_pelajaran }} {{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</h3> --}}
        {{-- <table class="table">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama Kuis</th>
                <th scope="col">Nilai</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($kuiss as $kuis)
              <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $kuis->judul_kuis }}</td>
                @foreach ($kuis->pengumpulanTugas as $pengumpulan)
                <td>{{ $pengumpulan->nilai }}</td>
                @endforeach
              </tr>
              @endforeach
            </tbody>
        </table> --}}

        <table class="table">
            <thead>
              <tr>
                <th scope="col">Nilai Rata-Rata Tugas</th>
                {{-- <th scope="col">Nilai Rata-Rata Kuis</th> --}}
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $rataTugas }}</td>
                {{-- <td>{{ $rataRataKuis }}</td> --}}
              </tr>
            </tbody>
        </table>
    
    </body>    
</body>
</html>