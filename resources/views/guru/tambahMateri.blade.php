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
        <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Tambah Materi</span>
      </div>
    </li>
    </ol>
</nav>
<h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Kelas {{ $kelas->mata_pelajaran }} {{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</h1>
{{-- <h1 class="text-base text-gray-900 sm:text-lg dark:text-white">{{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</h1> --}}
</div>

<div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-6 gap-6">
            {{-- <div class="col-span-6 sm:col-span-3">
                <label for="idmateri"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Materi</label>
                <input type="number" name="idmateri" id="idmateri"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ old('idmateri') }}" wfd-id="id1" >

                    @error('idmateri')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div> --}}
            
            <div class="col-span-6 sm:col-span-3">
                <label for="judul_materi"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Materi</label>
                <input type="text" name="judul_materi" id="judul_materi"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ old('judul_materi') }}" wfd-id="id2" >

                    @error('judul_materi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div>

            <div class="col-span-6 sm:col-span-3"> 
                <label for="deskripsi_materi" 
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Materi</label>
                <textarea id="deskripsi_materi" name="deskripsi_materi" rows="6"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    >{{ old('deskripsi_materi') }}</textarea>

                    @error('deskripsi_materi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>

            {{-- <div class="col-span-6 sm:col-span-3">
                <label for="file_materi"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Berkas Materi</label>
                <input type="file" name="file_materi" id="file_materi"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    wfd-id="id2" >

                    @error('file_materi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div> --}}

            <div class="col-span-6 sm:col-span-3">
                <label for="file_materi"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Berkas Materi</label>
                <input type="file" name="file_materi" id="file_materi"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
            
                @error('file_materi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- <div class="col-span-6 sm:col-span-3">
                <label for="tanggal_upload"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Unggah</label>
                <input type="date" name="tanggal_upload" id="tanggal_upload"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ old('tanggal_upload') }}" wfd-id="id2" >

                    @error('tanggal_upload')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div> --}}

            <div class="col-span-6 sm:col-span-3">
                <label for="tanggal_upload" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Unggah</label>
                <input type="date" name="tanggal_upload" id="tanggal_upload" class="shadow-sm bg-gray-200 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                value="{{ old('tanggal_upload') }}" readonly>
                
                @error('tanggal_upload')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const tanggalUploadInput = document.getElementById('tanggal_upload');
                    if (!tanggalUploadInput.value) {
                        const today = new Date().toISOString().split('T')[0];
                        tanggalUploadInput.value = today;
                    }
                });
            </script>

            {{-- <div class="col-span-6 sm:col-span-3">
                <label for="idkelas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Kelas</label>
                <select name="idkelas" id="idkelas" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" disabled selected>Pilih ID Kelas</option>
                    <option value="{{ $kelas->idkelas }}">{{ $kelas->idkelas }}</option>
                </select>
            </div> --}}

            <div class="col-span-6 sm:col-span-3" hidden>
                <label for="idkelas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Kelas</label>
                <select name="idkelas" id="idkelas" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="{{ $kelas->idkelas }}">{{ $kelas->idkelas }}</option>
                </select>

                @error('idkelas')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            
            <div class="col-span-6 sm:col-full">
                <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    type="submit" name="submit">
                    Tambah Materi
                </button>
            </div>                       
        </div>
    </form>
    
</div>

@endsection