@extends('siswa.layouts.layout')

@section('content')
<div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
    <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Dasbor</h2>
    {{-- <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">We use an agile approach to test assumptions and connect with the needs of your audience early and often.</p> --}}
</div>
<!--Tabs widget -->
<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">Linimasa Tugas dan Kuis
    </h3>
    <div class="sm:hidden">
      <label for="tabs" class="sr-only">Select tab</label>
      <select id="tabs" class="bg-red-50 border-0 border-b border-red-200 text-red-900 text-sm rounded-t-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-red-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
          <option>Statistics</option>
          <option>Services</option>
          <option>FAQ</option>
      </select>
    </div>  
    <ul class="hidden text-sm font-medium text-center text-red-500 divide-x divide-red-200 rounded-lg sm:flex dark:divide-red-600 dark:text-red-400" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
      <li class="w-full">
          <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-red-50 hover:bg-red-100 focus:outline-none dark:bg-red-700 dark:hover:bg-red-600">Belum Dikerjakan</button>
      </li>
      <li class="w-full">
          <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false" class="inline-block w-full p-4 rounded-tr-lg bg-red-50 hover:bg-red-100 focus:outline-none dark:bg-red-700 dark:hover:bg-red-600">Sudah Dikerjakan</button>
      </li>
    </ul>  
    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
        <div class="hidden pt-4" id="faq" role="tabpanel" aria-labelledby="faq-tab">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">

                @foreach($tugass as $tugas)
                  @if($tugas->pengumpulanTugas->count() == 0)
                      <li class="py-3 sm:py-4">
                          <div class="flex items-center space-x-4">
                              <div class="flex-shrink-0">
                                  <img src="{{ URL('images/tugas.png') }}" alt="tugas" class="w-6 h-6">                  
                              </div>
                              <div class="flex-1 min-w-0">
                                  <p class="font-medium text-gray-900 truncate dark:text-white">
                                      {{ $tugas->judul_tugas }}
                                  </p>
                                  <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                      {{ $tugas->kelas->mata_pelajaran }} {{ $tugas->kelas->jenjang_kelas }}{{ $tugas->kelas->indeks_kelas }}
                                  </p>
                                  <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                      {{ $tugas->tanggal_selesai }}
                                  </p>
                              </div>
                              <a href="{{ route('siswamasuk.index', $tugas->kelas->idkelas) }}" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-red-700 sm:text-sm hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-700">
                                  masuk kelas
                                  <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                              </a>                  
                          </div>
                      </li>
                  @endif
              @endforeach
              
                @foreach($kuiss as $kuis)
                @if($kuis->pengumpulanKuis !== null && $kuis->pengumpulanKuis->count() == 0)
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
                          {{ $kuis->kelas->mata_pelajaran }} {{ $kuis->kelas->jenjang_kelas }}{{ $kuis->kelas->indeks_kelas }}
                        </p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                          {{ $kuis->tanggal_selesai }}
                        </p>
                    </div>
                    <a href="{{ route('siswamasuk.index', $tugas->kelas->idkelas) }}" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-red-700 sm:text-sm hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-700">
                      masuk kelas
                      <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                  </div>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
        <div class="hidden pt-4" id="about" role="tabpanel" aria-labelledby="about-tab">
          <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($tugass as $tugas)
                  @if($tugas->pengumpulanTugas->count() > 0)
                      <li class="py-3 sm:py-4">
                          <div class="flex items-center space-x-4">
                              <div class="flex-shrink-0">
                                <img src="{{ URL('images/tugas.png') }}" alt="tugas" class="w-6 h-6">                      
                              </div>
                              <div class="flex-1 min-w-0">
                                  <p class="font-medium text-gray-900 truncate dark:text-white">
                                      {{ $tugas->judul_tugas }}
                                  </p>
                                  <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                      {{ $tugas->kelas->mata_pelajaran }} {{ $tugas->kelas->jenjang_kelas }}{{ $tugas->kelas->indeks_kelas }}
                                  </p>
                                  <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                      {{ $tugas->tanggal_selesai }}
                                  </p>
                              </div>
                              <a href="{{ route('siswamasuk.index', $tugas->kelas->idkelas) }}" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-red-700 sm:text-sm hover:bg-gray-100 dark:text-red-500 dark:hover:bg-gray-700">
                                  masuk kelas
                                  <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                              </a>                  
                          </div>
                      </li>
                  @endif
              @endforeach
            
              {{-- <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                  </div>
                  <div class="flex-1 min-w-0">
                      <p class="font-medium text-gray-900 truncate dark:text-white">
                          Nama kuis
                      </p>
                      <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                          Nama kelas
                      </p>
                  </div>
                </div>
              </li> --}}
          </ul>
        </div>
    </div>
  </div>
</div>
@endsection
