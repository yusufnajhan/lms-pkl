@extends('guru.layouts.layout')

@section('content')
<div class="mb-4">
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
              <svg class="w-6 h-6 text-red-400" fill="red" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <a href="{{ route('tugaskuis.index', $kelas->idkelas) }}" class="ml-1 text-red-700 hover:text-primary-600 md:ml-2 dark:text-red-300 dark:hover:text-white">{{ $kelas->mata_pelajaran }} {{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</a>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Progres Siswa</span>
            </div>
          </li>
        </ol>
    </nav>
    <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2 w-1/2">
      <div class="items-center bg-gray-50 rounded-lg shadow sm:flex dark:bg-gray-800 dark:border-gray-700">
          <a href="#">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="ml-3 w-12 h-12 rounded-full">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
          </a>        
          <div class="p-5">
              <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                  <a href="#">{{ $siswa->nama }}</a>
              </h3>
              <span class="text-gray-500 dark:text-gray-400">{{ $siswa->nik }}</span>
              <p class="mb-4 font-light text-gray-500 dark:text-gray-400">{{ $siswa->email }}</p>
              <a href="{{ route('progres.rekap', $siswa->idsiswa) }}" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-red-900 bg-white border border-red-300 rounded-lg hover:bg-red-100 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-red-800 dark:text-red-400 dark:border-red-600 dark:hover:text-white dark:hover:bg-red-700 dark:focus:ring-red-700">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="red" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path></svg>
                Unduh Rekap
              </a>
          </div>
        </div> 
    </div>

    <h1 class="mt-6 text-lg font-semibold text-gray-900 sm:text-xl dark:text-white">Progres Tugas</h1>

    <div class="mt-4 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select tab</label>
            <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option>Statistics</option>
                <option>Services</option>
            </select>
        </div>
        <ul class="hidden text-sm font-medium text-center text-red-500 divide-x divide-red-200 rounded-lg sm:flex dark:divide-red-600 dark:text-red-400" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
          <li class="w-full">
            <button id="sudah-tab" data-tabs-target="#sudah" type="button" role="tab" aria-controls="sudah" aria-selected="true" class="inline-block w-full p-4 rounded-tr-lg bg-red-50 hover:bg-red-100 focus:outline-none dark:bg-red-700 dark:hover:bg-red-600">Sudah Dikumpulkan</button>
          </li>
          <li class="w-full">
              <button id="belum-tab" data-tabs-target="#belum" type="button" role="tab" aria-controls="belum" aria-selected="false" class="inline-block w-full p-4 rounded-tl-lg bg-red-50 hover:bg-red-100 focus:outline-none dark:bg-red-700 dark:hover:bg-red-600">Belum Dikumpulkan</button>
          </li>
        </ul> 
        
        <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
              <div class="hidden pt-4" id="sudah" role="tabpanel" aria-labelledby="sudah-tab">
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="py-2 dark:text-white">No.</th>
                            <th class="py-2 dark:text-white">Judul Tugas</th>
                            <th class="py-2 dark:text-white">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($tugasDikumpulkan as $key => $tugas)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                              
                                <td class="py-3 text-center dark:text-white">{{ $key + 1 }}.</td>
                                <td class="py-3 text-center dark:text-white">{{ $tugas->tugas->judul_tugas }}</td>
                                <td class="py-3 text-center dark:text-white">{{ $tugas->nilai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="hidden pt-4" id="belum" role="tabpanel" aria-labelledby="belum-tab">
              <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                  <thead class="bg-gray-100 dark:bg-gray-700">
                      <tr>
                          <th class="py-2 dark:text-white">No.</th>
                          <th class="py-2 dark:text-white">Judul Tugas</th>
                      </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                      @php $no = 1; @endphp
                      @foreach($tugasBelumDikumpulkan as $tugas)
                          <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            
                              <td class="py-3 text-center dark:text-white">{{ $no++ }}.</td>
                              <td class="py-3 text-center dark:text-white">{{ $tugas->judul_tugas }}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
            
        </div>
    </div>
    
    <h1 class="mt-6 text-lg font-semibold text-gray-900 sm:text-xl dark:text-white">Progres Kuis</h1>
    <div class="mt-4 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select tab</label>
            <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option>Statistics</option>
                <option>Services</option>
            </select>
        </div>
        <ul class="hidden text-sm font-medium text-center text-red-500 divide-x divide-red-200 rounded-lg sm:flex dark:divide-red-600 dark:text-red-400" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
          <li class="w-full">
            <button id="sudahkuis-tab" data-tabs-target="#sudahkuis" type="button" role="tab" aria-controls="sudahkuis" aria-selected="true" class="inline-block w-full p-4 rounded-tr-lg bg-red-50 hover:bg-red-100 focus:outline-none dark:bg-red-700 dark:hover:bg-red-600">Sudah Dikumpulkan</button>
          </li>
          <li class="w-full">
              <button id="belumkuis-tab" data-tabs-target="#belumkuis" type="button" role="tab" aria-controls="belumkuis" aria-selected="false" class="inline-block w-full p-4 rounded-tl-lg bg-red-50 hover:bg-red-100 focus:outline-none dark:bg-red-700 dark:hover:bg-red-600">Belum Dikumpulkan</button>
          </li>
        </ul> 
        
        <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
              <div class="hidden pt-4" id="sudahkuis" role="tabpanel" aria-labelledby="sudahkuis-tab">
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="py-2 dark:text-white">No.</th>
                            <th class="py-2 dark:text-white">Judul Kuis</th>
                            <th class="py-2 dark:text-white">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($kuisDikumpulkan as $key => $kuis)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                              
                                <td class="py-3 text-center dark:text-white">{{ $key + 1 }}.</td>
                                <td class="py-3 text-center dark:text-white">{{ $kuis->kuis->judul_kuis }}</td>
                                <td class="py-3 text-center dark:text-white">{{ $kuis->nilai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="hidden pt-4" id="belumkuis" role="tabpanel" aria-labelledby="belumkuis-tab">
              <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                  <thead class="bg-gray-100 dark:bg-gray-700">
                      <tr>
                          <th class="py-2 dark:text-white">No.</th>
                          <th class="py-2 dark:text-white">Judul Kuis</th>
                      </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                      @php $no = 1; @endphp
                      @foreach($kuisBelumDikumpulkan as $kuis)
                          <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            
                              <td class="py-3 text-center dark:text-white">{{ $no++ }}.</td>
                              <td class="py-3 text-center dark:text-white">{{ $kuis->judul_kuis }}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
            
        </div>
    </div>

</div>
@endsection