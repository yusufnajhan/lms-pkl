@extends('siswa.layouts.layout')

@section('content')
<section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
            <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Kelas Saya</h2>
            {{-- <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">We use an agile approach to test assumptions and connect with the needs of your audience early and often.</p> --}}
        </div> 
        {{-- <div class="flex items-center">
            <button id="dropdownDefault" data-dropdown-toggle="dropdown"
              class="mb-4 sm:mb-0 mr-4 inline-flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
              type="button">
              Saring kelas
              <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="red" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
              <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                Status kelas
              </h6>
              <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                <li class="flex items-center">
                  <input id="apple" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
          
                  <label for="apple" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                    Aktif
                  </label>
                </li>
                <li class="flex items-center">
                  <input id="fitbit" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
          
                  <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                    Tidak aktif
                  </label>
                </li>
              </ul>
            </div>
        </div> --}}

        <form action="{{ route('siswakelas.index') }}" method="GET">
            <div class="flex items-center">
                <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                    class="mb-4 sm:mb-0 mr-4 inline-flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button">
                    Saring kelas
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="red" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                    {{-- <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                        Status kelas
                    </h6> --}}
                    <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                        <li class="flex items-center">
                            <input id="semua" name="status" type="radio" value="semua" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                            <label for="semua" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                Semua kelas
                            </label>
                        </li>
                        <li class="flex items-center">
                            <input id="aktif" name="status" type="radio" value="aktif" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                            <label for="aktif" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                Kelas aktif
                            </label>
                        </li>
                        <li class="flex items-center">
                            <input id="tidak_aktif" name="status" type="radio" value="tidak aktif" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                            <label for="tidak_aktif" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                Kelas tidak aktif
                            </label>
                        </li>
                    </ul>
                    <button type="submit" class="mt-3 w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-500">Terapkan</button>
                </div>
            </div>
        </form>
        

        <div class="grid gap-8 lg:grid-cols-2 mt-6">
            @foreach($kelass as $kelas)
            <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a href="#">{{ $kelas->mata_pelajaran }}</a></h2>
                <h2 class="mb-2 text-xl tracking-tight text-gray-900 dark:text-white"><a href="#">Kelas {{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</a></h2>
                {{-- <p class="mb-5 font-light text-gray-500 dark:text-gray-400">Deskripsi kelas</p>                                        --}}
                <div class="mt-4 flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <img src="{{ URL('images/guru.png') }}" alt="guru" class="w-6 h-6 rounded-full">
                        <span class="font-medium dark:text-white">
                            {{ $kelas->guru->nama }}
                        </span>
                    </div>
                    @if(!$kelas->isExpired)
                    <a href="{{ route('siswamasuk.index', $kelas->idkelas) }}" class="inline-flex items-center font-medium text-red-600 dark:text-red-500 hover:underline">
                        Masuk kelas
                        <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                    @else
                    <span class="inline-flex items-center font-medium text-gray-600 dark:text-gray-500">
                        Kelas tutup
                    </span>
                    @endif
                </div>
            </article>  
            @endforeach               
        </div>  
    </div>
</section>
@endsection