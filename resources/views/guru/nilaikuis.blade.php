@extends('guru.layouts.layout')

@section('content')
<div class="mb-4">
  @if(session()->has('success'))
  <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
      <p>{{ session('success') }}</p>
  </div>
  @endif
  @if (session()->has('error'))
  <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
      <p>{{ session('error') }}</p>
  </div>
  @endif
  <nav class="flex mb-5" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
        <li class="inline-flex items-center">
          <a href="/kelasGuru"
              class="flex items-center p-2 text-base text-red-900 rounded-lg hover:bg-red-100 group dark:text-red-200 dark:hover:bg-red-700 ">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                  </svg>                                      
              <span class="ml-3" sidebar-toggle-item="">Kelas</span>
          </a>
        </li>
        <li>
          <div class="flex items-center">
            <svg class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            <a href="{{ route('tugaskuis.index', $kelas->idkelas) }}" class="ml-1 text-red-700 hover:text-primary-600 md:ml-2 dark:text-red-300 dark:hover:text-white">{{ $kelas->mata_pelajaran }} {{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</a>
          </div>
        </li>
        <li>
          <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Penilaian Kuis</span>
          </div>
        </li>
      </ol>
  </nav>
  <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Rekap Kuis {{ $kuis->judul_kuis }} </h1>
  <div class="grid w-full grid-cols-1 gap-4 mt-4">
    <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
      <div class="w-full text-center">
        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Sudah Mengumpulkan</h3>
        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $jumlahPengumpulan }}</span>
      </div>

      <div class="w-full text-center">
        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Belum Mengumpulkan</h3>
        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $belumMengumpulkan }}</span>
      </div>

      <div class="w-full text-center">
        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Nilai Tertinggi</h3>
        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $nilaiTertinggi }}</span>
      </div>

      <div class="w-full text-center">
        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Nilai Rata-Rata</h3>
        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $nilaiRata }}</span>
      </div>

      <div class="w-full text-center">
        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Nilai Terendah</h3>
        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $nilaiTerendah }}</span>
      </div>
    </div>
</div>
</div>

<div class="flex justify-between">
  <form class="lg:pr-3" action="{{ route('kuis.read', $kuis->idkuis) }}" method="GET">
      <label for="users-search" class="sr-only">Search</label>
      <div class="flex items-center relative mt-1 lg:w-64 xl:w-96">
          <input type="text" name="search" id="users-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mencari nama siswa">
          <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-red-700 rounded-lg border border-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </button>
      </div>
  </form>
  <a href="{{ route('kuis.downloadRekap', $kuis->idkuis) }}" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-red-900 bg-white border border-red-300 rounded-lg hover:bg-red-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-red-800 dark:text-red-400 dark:border-red-600 dark:hover:text-white dark:hover:bg-red-700 dark:focus:ring-red-700">
    <svg class="w-5 h-5 mr-2 -ml-1" fill="red" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path></svg>
    Unduh Rekap
  </a>
</div>

<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
  <table id="tabelPengumpulanTugas" class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
      <thead class="bg-gray-100 dark:bg-gray-700">
          <tr>
              <th scope="col" class="py-2 dark:text-white">No.</th>
              <th scope="col" class="py-2 dark:text-white">Nama Siswa</th>
              <th scope="col" class="py-2 dark:text-white">NIM</th>
              <th scope="col" class="py-2 dark:text-white">Nilai Kuis</th>
              <th scope="col" class="py-2 dark:text-white">Jawaban Kuis</th>
          </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
          @foreach($pengumpulanKuis as $key => $pengumpulan)
              <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                  <td scope="col" class="py-3 text-center dark:text-white">{{ $key + 1 }}.</td>
                  <th class="py-3 text-center dark:text-white">{{ $pengumpulan->siswa->nama }}</th>
                  <td class="py-3 text-center dark:text-white">{{ $pengumpulan->siswa->nik }}</td>
                  <td class="py-3 text-center dark:text-white">{{ $pengumpulan->nilai }}</td>
                  <input type="hidden" name="idpengumpulan" value="{{ $pengumpulan->idpengumpulan }}">
                  {{-- <td class="py-3 text-center dark:text-white">
                    <form action="{{ route('guru.updateNilai2', ['idkuis' => $kuis->idkuis]) }}" method="POST" class="flex justify-between">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="idsiswa" value="{{ $pengumpulan->idsiswa }}">
                        <input type="number" id="nilai" name="nilai" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-1/2 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="nilai kuis (1-100)" value="{{ $pengumpulan->nilai }}" required>
                        <button type="submit" class="focus:outline-none text-white text-xs bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg px-4 py-1.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Simpan</button>
                    </form>
                  </td>                 --}}
                  <td class="py-3 text-center dark:text-white">
                      <a href="{{ route('guru.lihatJawaban', ['idkuis' => $kuis->idkuis, 'idsiswa' => $pengumpulan->idsiswa]) }}" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-red-700 sm:text-sm hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-700">
                          lihat jawaban
                          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                      </a>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
</div>

@endsection