@extends('guru.layouts.layout')

@section('content')
<div class="mb-4">
    <nav class="flex mb-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
          <li class="inline-flex items-center">
            <a href="/kelasGuru"
            class="flex items-center p-2 text-base text-red-900 rounded-lg hover:bg-red-100 group dark:text-gray-200 dark:hover:bg-gray-700 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
            </svg>                                      
                <span class="ml-3" sidebar-toggle-item="">Kelas</span>
            </a>
          <li>
            <div class="flex items-center">
              <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Tambah Kelas</span>
            </div>
          </li>
        </ol>
    </nav>
    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Kelas Baru</h1>
</div>

<div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
                <label for="idkelas"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Kelas</label>
                <input type="number" name="idkelas" id="idkelas"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ old('idkelas') }}" wfd-id="id1" >

                    @error('idkelas')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="mata_pelajaran" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mata Pelajaran</label>
                <select name="mata_pelajaran" id="mata_pelajaran" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" disabled selected>Pilih Mata Pelajaran</option>
                    <option value="Agama"{{ old('mata_pelajaran') == 'Agama' ? 'selected' : '' }}>Agama dan Budi Pekerti</option>
                    <option value="Matematika"{{ old('mata_pelajaran') == 'Matematika' ? 'selected' : '' }}>Matematika</option>
                    <option value="Bahasa Inggris"{{ old('mata_pelajaran') == 'Bahasa Inggris' ? 'selected' : '' }}>Bahasa Inggris</option>
                    <option value="Bahasa Indonesia"{{ old('mata_pelajaran') == 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
                    <option value="PKN"{{ old('mata_pelajaran') == 'PKN' ? 'selected' : '' }}>Pendidikan Kewarganegaraan (PKN)</option>
                    <option value="IPAS"{{ old('mata_pelajaran') == 'IPAS' ? 'selected' : '' }}>Ilmu Pengetahuan Alam dan Sosial (IPAS)</option>
                    <option value="IPS"{{ old('mata_pelajaran') == 'IPS' ? 'selected' : '' }}>Ilmu Pengetahuan Sosial (IPS)</option>
                    <option value="Informatika"{{ old('mata_pelajaran') == 'Informatika' ? 'selected' : '' }}>Informatika</option>
                    <option value="Prakarya"{{ old('mata_pelajaran') == 'Prakarya' ? 'selected' : '' }}>Prakarya</option>
                    <option value="PJOK"{{ old('mata_pelajaran') == 'PJOK' ? 'selected' : '' }}>Pendidikan Jasmani, Olahraga, dan Kesehatan (PJOK)</option>
                </select>
            
                @error('mata_pelajaran')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="col-span-6 sm:col-span-3">
                <label for="indeks_kelas"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Indeks Kelas</label>
                <input type="text" name="indeks_kelas" id="indeks_kelas"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ old('indeks_kelas') }}" wfd-id="id2" >

                    @error('indeks_kelas')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="jenjang_kelas"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenjang Kelas</label>
                <select name="jenjang_kelas" id="jenjang_kelas"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ old('jenjang_kelas') }}" wfd-id="id2">
                    <option value="" disabled selected>Pilih Jenjang Kelas</option>
                    <option value="7"{{ old('jenjang_kelas') == '7' ? 'selected' : '' }}>Kelas 7</option>
                    <option value="8"{{ old('jenjang_kelas') == '8' ? 'selected' : '' }}>Kelas 8</option>
                    <option value="9"{{ old('jenjang_kelas') == '9' ? 'selected' : '' }}>Kelas 9</option>
                </select>
            
                    @error('jenjang_kelas')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="tanggal_dibuat"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Dibuat</label>
                <input type="date" name="tanggal_dibuat" id="tanggal_dibuat"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ old('tanggal_dibuat') }}" wfd-id="id2" >

                    @error('tanggal_dibuat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="tanggal_tutup"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Tutup</label>
                <input type="date" name="tanggal_tutup" id="tanggal_tutup"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ old('tanggal_tutup') }}" wfd-id="id2" >

                    @error('tanggal_tutup')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="idguru" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Guru</label>
                <select name="idguru" id="idguru" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="" disabled selected>Pilih ID Guru</option>
                    <option value="{{ auth()->user()->guru->idguru }}">{{ auth()->user()->guru->idguru }}</option>
                </select>

                @error('idguru')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            
            <div class="col-span-6 sm:col-full">
                <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    type="submit" name="submit">
                    Tambah kelas
                </button>
            </div>                       
        </div>
    </form>
    
</div>
@endsection