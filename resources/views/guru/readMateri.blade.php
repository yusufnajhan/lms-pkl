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
        <a href="{{ route('tugaskuis.index', $kelas->idkelas) }}">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-black" fill="red" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="flex items-center p-2 text-base text-red-900 rounded-lg hover:bg-red-100 group dark:text-red-200 dark:hover:bg-red-700 " aria-current="page">{{ $kelas->mata_pelajaran }} {{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</span>
            </div>
        </a>
    </li> 
    <li>
        <a href="{{ route('materi.index', $kelas->idkelas) }}">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-black" fill="red" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                <span class="flex items-center p-2 text-base text-red-900 rounded-lg hover:bg-red-100 group dark:text-red-200 dark:hover:bg-red-700 " aria-current="page">Materi Kelas</span>
            </div>
        </a>
    </li> 
    <li>
      <div class="flex items-center">
        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Detail Materi</span>
      </div>
    </li>
    </ol>
</nav>
    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ $materi->judul_materi }}</h1>
    {{-- <h1 class="text-base text-gray-900 sm:text-lg dark:text-white">{{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</h1> --}}
    <footer class="mt-5 flex items-center justify-between mb-2">
        <div class="flex items-center">
          <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08" title="February 8th, 2022">Diunggah pada: {{ $materi->tanggal_upload }}</time></p>
        </div>
  </footer>
</div>

<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <form class="overflow-y-auto lg:max-h-[60rem] 2xl:max-h-fit">
        <article class="mb-5">
          <p class="text-sm font-bold text-gray-600 dark:text-gray-400">Deskripsi:</p>
          <p class="mt-3 mb-2 text-gray-900 dark:text-white">
            {{ $materi->deskripsi_materi }}
          </p>
    
          <p class="mt-5 text-sm font-bold text-gray-600 dark:text-gray-400">Berkas materi:</p>
          <div class="items-center 2xl:space-x-4 2xl:flex">
            <div class="mt-8 flex items-center space-x-4">
                {{-- <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">File Materi</dt> --}}
                <a href="{{ asset('storage/' . $materi->file_materi) }}" target="_blank"
                    class="ml-2 w-24 h-12 bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400 inline-flex items-center justify-center">Lihat
                    berkas</a></label>
            </div>

        </div>
    </div>
  </article>
</form>
</div>

{{-- <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <p class="mb-4 text-xl font-extrabold leading-none text-gray-900 md:text-2xl dark:text-white">{{ $materi->judul_materi }}</p>
        <dl class="mt-8 flex items-center space-x-6">
            <div>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Tanggal Upload</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $materi->tanggal_upload }}</dd>
            </div>
        </dl>
        <dl>
            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Deskripsi</dt>
            <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $materi->deskripsi_materi }}</dd>
        </dl>
        <div class="mt-8 flex items-center space-x-4">
            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">File Materi</dt>
            <a href="{{ asset('storage/' . $materi->file_materi) }}"
                class="ml-2 w-24 h-12 bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400 inline-flex items-center justify-center">Lihat
                file</a></label>
        </div>
    </div>
  </section> --}}

  @endsection