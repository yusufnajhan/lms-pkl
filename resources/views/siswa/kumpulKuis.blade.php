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
              <svg class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <a href="{{ route('siswamasuk.index', $kelas->idkelas) }}" class="ml-1 text-red-700 hover:text-primary-600 md:ml-2 dark:text-red-300 dark:hover:text-white">{{ $kelas->mata_pelajaran }} {{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</a>
            </div>
          </li>
          <li>
            <div class="flex items-center">
              <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Pengumpulan Kuis</span>
            </div>
          </li>
        </ol>
    </nav>
    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ $kuis->judul_kuis }}</h1>
</div>

<div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <form action="{{ route('kumpulkuis.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-6 gap-6">

            <div class="col-span-6 sm:col-span-3" hidden>
                <label for="status"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Kuis</label>
                <select name="status" id="status"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" wfd-id="id2">
                    <option value="1"{{ old('status') == '1' ? 'selected' : ''}}>Sudah dikerjakan</option>
                </select>
            
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>

            <div class="col-span-6 sm:col-span-3" hidden>
                <label for="tanggal_pengumpulan"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pengumpulan</label>
                <input type="date" name="tanggal_pengumpulan" id="tanggal_pengumpulan"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ date('Y-m-d') }}" wfd-id="id2" >
            
                @error('tanggal_pengumpulan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>   

            <div class="col-span-6 sm:col-span-3" hidden>
                <label for="idkuis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Kuis</label>
                <select name="idkuis" id="idkuis" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="{{ $kuis->idkuis }}">{{ $kuis->idkuis }}</option>
                </select>
            </div>         

            <div class="col-span-6 sm:col-span-3" hidden>
                <label for="idkuis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Kuis</label>
                <select name="idkuis" id="idkuis" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="{{ $kuis->idkuis }}">{{ $kuis->idkuis }}</option>
                </select>
            </div>
            
            <div class="col-span-6 sm:col-span-3" hidden>
                <label for="idguru" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Guru</label>
                <select name="idguru" id="idguru" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="{{ $guru->idguru }}">{{ $guru->idguru }}</option>
                </select>
            </div>

            <div class="col-span-6 sm:col-span-3" hidden>
                <label for="idsiswa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Siswa</label>
                <select name="idsiswa" id="idsiswa" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="{{ auth()->user()->dataPribadi->idsiswa }}" selected>{{ auth()->user()->dataPribadi->idsiswa }}</option>
                </select>
            </div>
    
            @php
            $counter = 1;
            @endphp

            @foreach($kuis->soalkuis as $index => $soal)
            <div class="col-span-6 sm:col-span-3">
                <label for="soal_{{ $index + 1 }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Soal {{ $index + 1 }}</label>
                <textarea name="soal_{{ $index + 1 }}" id="soal_{{ $index + 1 }}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    readonly>{{ $soal->pertanyaan }}</textarea>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="jawaban_{{ $index + 1 }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jawaban Soal {{ $index + 1 }}</label>
                <textarea name="jawaban[{{ $soal->idsoal }}]" id="jawaban_{{ $index + 1 }}"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required></textarea>
            </div>
            @endforeach

            <div class="col-span-6 sm:col-full">
                <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    type="submit" name="submit">
                    Kumpul Kuis
                </button>
            </div>                       
        </div>
    </form>
</div>
@endsection