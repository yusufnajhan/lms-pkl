@extends('siswa.layouts.layout')
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
            <a href="/kelasSiswa"
                class="flex items-center p-2 text-base text-red-900 rounded-lg hover:bg-red-100 group dark:text-red-200 dark:hover:bg-red-700 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>                                      
                <span class="ml-3" sidebar-toggle-item="">Kelas Saya</span>
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">{{ $kelas->mata_pelajaran }} {{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</span>
            </div>
          </li>
        </ol>
    </nav>
    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Kelas {{ $kelas->mata_pelajaran }} {{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</h1>
    {{-- <h1 class="text-base text-gray-900 sm:text-lg dark:text-white">Deskripsi kelas</h1> --}}
</div>
<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="sm:hidden">
        <label for="tabs" class="sr-only">Select tab</label>
        <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option>Statistics</option>
            <option>Services</option>
            <option>FAQ</option>
            <option>Teman</option>
        </select>
    </div>
    <ul class="hidden text-sm font-medium text-center text-red-500 divide-x divide-red-200 rounded-lg sm:flex dark:divide-red-600 dark:text-red-400" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
      <li class="w-full">
          <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-red-50 hover:bg-red-100 focus:outline-none dark:bg-red-700 dark:hover:bg-red-600">Tugas</button>
      </li>
      <li class="w-full">
          <a href="{{ route('materi.index2', $kelas->idkelas) }}" class="inline-block w-full p-4 rounded-tr-lg hover:bg-transparent focus:outline-none dark:bg-transparent dark:hover:bg-transparent text-gray-500">Materi</a>
      </li>
      <li class="w-full">
          <a href="{{ route('diskusi.index2', $kelas->idkelas) }}" class="inline-block w-full p-4 rounded-tr-lg hover:bg-transparent focus:outline-none dark:bg-transparent dark:hover:bg-transparent text-gray-500">Diskusi</a>
      </li>
      <li class="w-full">
        <button id="teman-tab" data-tabs-target="#teman" type="button" role="tab" aria-controls="teman" aria-selected="false" class="inline-block w-full p-4 rounded-tr-lg bg-red-50 hover:bg-red-100 focus:outline-none dark:bg-red-700 dark:hover:bg-red-600">Teman Kelas</button>
      </li>
    </ul>  
    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
        <div class="hidden pt-4" id="faq" role="tabpanel" aria-labelledby="faq-tab">
          <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
            <form action="{{ route('siswamasuk.index', $kelas->idkelas) }}" method="GET">
              <div class="flex items-center">
                  <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                      class="mb-4 sm:mb-0 mr-4 inline-flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                      type="button">
                      Saring tugas
                      <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="red" viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                      </svg>
                  </button>
                  <!-- Dropdown menu -->
                  <div id="dropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                      <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                          <li class="flex items-center">
                              <input id="semua" name="status" type="radio" value="semua" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                              <label for="semua" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                  Semua tugas & kuis
                              </label>
                          </li>
                          <li class="flex items-center">
                            <input id="telah" name="status" type="radio" value="telah" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                            <label for="telah" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                Sudah dikerjakan
                            </label>
                          </li> 
                          <li class="flex items-center">
                              <input id="belum" name="status" type="radio" value="belum" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                              <label for="belum" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                  Belum dikerjakan
                              </label>
                          </li>
                      </ul>
                      <button type="submit" class="mt-3 w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-500">Terapkan</button>
                  </div>
              </div>
            </form>
            <a href="{{ route('siswamasuk.rekapTugas', $kelas->idkelas) }}" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-red-900 bg-white border border-red-300 rounded-lg hover:bg-red-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-red-800 dark:text-red-400 dark:border-red-600 dark:hover:text-white dark:hover:bg-red-700 dark:focus:ring-red-700">
              <svg class="w-5 h-5 mr-2 -ml-1" fill="red" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path></svg>
              Rekap Tugas
            </a>
          </div> 
      
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
              @foreach($tugass as $tugas)
                <li class="py-3 sm:py-4">
                  <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                      <a href="{{ route('siswamasuk.read', $tugas->idtugas) }}">
                        <img src="{{ URL('images/tugas.png') }}" alt="tugas" class="w-6 h-6">
                      </a>
                    </div>
                    <style>
                      a.hover-red-underline:hover {
                          text-decoration: underline;
                          text-decoration-color: red;
                      }
                    </style>
                    <div class="flex-1 min-w-0">
                      <p class="font-medium text-gray-900 truncate dark:text-white">
                        <a href="{{ route('siswamasuk.read', $tugas->idtugas) }}" class="hover-red-underline">{{ $tugas->judul_tugas }}</a>
                      </p>
                      <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                        <a href="{{ route('siswamasuk.read', $tugas->idtugas) }}" class="hover-red-underline">{{ $tugas->tanggal_selesai }}</a>
                      </p>
                    </div>

                    @php
                        $pengumpulan = $kumpultugas->where('idtugas', $tugas->idtugas)->first();
                    @endphp
                    @if($pengumpulan && !is_null($pengumpulan->nilai))
                        <p class="font-medium text-gray-600 truncate dark:text-white">
                          <span>Nilai: {{ $pengumpulan->nilai }}/100</span>
                            {{-- <a href="">Nilai: {{ $pengumpulan->nilai }}/100</a> --}}
                        </p>
                    @endif

                    @php
                        $pengumpulan = $kumpultugas->where('idtugas', $tugas->idtugas)->first();
                    @endphp
                    <td class="p-4 whitespace-nowrap">
                        @if ($pengumpulan && $pengumpulan->status == '1')
                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500">
                                Sudah dikerjakan
                            </span>
                        @else
                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-red-400 border border-red-100 dark:border-red-500">
                                Belum dikerjakan
                            </span>
                        @endif
                    </td>
                    {{-- @if(!$tugas->isExpired)
                    <a href="{{ route('kumpultugas.create', $tugas->idtugas) }}" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-red-700 sm:text-sm hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-700">
                      kumpul tugas
                      <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                    @else
                    <span class="inline-flex items-center font-medium text-gray-600 dark:text-gray-500">
                      Tugas tutup
                    </span>
                    @endif
                    <a href="{{ route('kumpultugas.edit', $tugas->idtugas) }}">
                      <button type="button" 
                        class="inline-flex items-center px-2 py-1 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900"
                        data-idtugas="{{ $tugas->idtugas }}">
                          <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                            Ubah
                      </button>
                    </a> --}}

                    {{-- @if(!$tugas->isExpired)
                        <a href="{{ route('kumpultugas.create', $tugas->idtugas) }}" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-red-700 sm:text-sm hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-700">
                            kumpul tugas
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                        <a href="{{ route('kumpultugas.edit', $tugas->idtugas) }}">
                            <button type="button" 
                                class="inline-flex items-center px-2 py-1 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900"
                                data-idtugas="{{ $tugas->idtugas }}">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                Ubah
                            </button>
                        </a>
                    @else
                        <span class="inline-flex items-center font-medium text-gray-600 dark:text-gray-500">
                            Tugas tutup
                        </span>
                    @endif --}}

                    @if(!$tugas->isExpired)
                        {{-- @php
                            $pengumpulan = \App\Models\Pengumpulan_Tugas::where('idtugas', $tugas->idtugas)
                                ->where('idsiswa', auth()->user()->idsiswa)
                                ->first();
                        @endphp --}}
                        @php
                          $pengumpulan = $kumpultugas->where('idtugas', $tugas->idtugas)->first();
                        @endphp

                        @if($pengumpulan)
                            <a href="{{ route('kumpultugas.edit', $tugas->idtugas) }}">
                                <button type="button" 
                                    class="inline-flex items-center px-2 py-1 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900"
                                    data-idtugas="{{ $tugas->idtugas }}">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                    Ubah
                                </button>
                            </a>
                        @else
                            <a href="{{ route('kumpultugas.create', $tugas->idtugas) }}" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-red-700 sm:text-sm hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-700">
                                kumpul tugas
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        @endif
                    @else
                        <span class="inline-flex items-center font-medium text-gray-600 dark:text-gray-500">
                            Tugas tutup
                        </span>
                    @endif


                  </div>
                </li>
                @endforeach

                {{-- @foreach($kuiss as $kuis)
                <li class="py-3 sm:py-4">
                  <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                      </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate dark:text-white">
                          {{ $kuis->judul_kuis }}
                        </p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                          {{ $kuis->tanggal_selesai }}
                        </p>
                    </div>
                    <td class="p-4 whitespace-nowrap">
                      <span
                        class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500">Sudah dikerjakan</span>
                    </td>
                    <a href="{{ route('siswa.detailkuis', $kuis->idkuis) }}" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-red-700 sm:text-sm hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-700">
                      Detail
                      <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                  </div>
                </li>
                @endforeach --}}
            </ul>
        </div>
        <div class="hidden pt-4" id="about" role="tabpanel" aria-labelledby="about-tab">
          <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>                    
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="font-medium text-gray-900 truncate dark:text-white">
                      Nama materi
                    </p>
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                      deskripsi materi
                    </p>
                  </div>
                  <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>                    
                    Unduh materi
                  </button>                
                </div>
              </li>
              <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>                    
                  </div>
                  <div class="flex-1 min-w-0">
                      <p class="font-medium text-gray-900 truncate dark:text-white">
                          Nama materi
                      </p>
                      <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                          Deskripsi materi
                      </p>
                  </div>
                  <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>                    
                    Unduh materi
                  </button>
                </div>
              </li>
              <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>                    
                  </div>
                  <div class="flex-1 min-w-0">
                      <p class="font-medium text-gray-900 truncate dark:text-white">
                          Nama materi
                      </p>
                      <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                          Deskripsi materi
                      </p>
                  </div>
                  <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>                    
                    Unduh materi
                  </button>
                </div>
              </li>
              <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>                    
                  </div>
                  <div class="flex-1 min-w-0">
                      <p class="font-medium text-gray-900 truncate dark:text-white">
                          Nama materi
                      </p>
                      <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                          Deskripsi materi
                      </p>
                  </div>
                  <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>                    
                    Unduh materi
                  </button>
                </div>
              </li>
          </ul>
        </div>
      <div class="hidden pt-4" id="teman" role="tabpanel" aria-labelledby="teman-tab">
        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
          @foreach($enrollments as $enrollment)
          <li class="py-3 sm:py-4">
            <div class="flex items-center space-x-4">
              <div class="flex-shrink-0">
                <img src="{{ URL('images/siswa.png') }}" alt="siswa" class="w-6 h-6 rounded-full">
              </div>
              <div class="flex-1 min-w-0">
                <p class="font-medium text-gray-900 truncate dark:text-white">
                  {{ $enrollment->siswa->nama }}
                </p>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
    </div>
    </div>
  </div>
</div>
@endsection