@extends('guru.layouts.layout')
@section('content')
<div class="mb-4">
    <nav class="flex mb-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
          <li class="inline-flex items-center">
            <a href="/kelasGuru"
                class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>                                      
                <span class="ml-3" sidebar-toggle-item="">Kelas</span>
            </a>
          </li>
          <li>
            <a href="/masukKelas">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-1 text-black md:ml-2" aria-current="page">{{ $kelas->mata_pelajaran }} {{ $kelas->jenjang_kelas }}{{ $kelas->indeks_kelas }}</span>
                </div>
            </a>
        </li>        
          <li>
            <div class="flex items-center">
              <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Tambah Soal</span>
            </div>
          </li>
        </ol>
    </nav>
    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Tambah Soal</h1>
</div>

<div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <form action="{{ route('kuis.storeSoal', $kuis->idkuis) }}" method="POST" >
        @csrf
        <div class="grid grid-cols-6 gap-6">
            
            <div class="col-span-6 sm:col-span-3">
                <label for="soal[1][pertanyaan]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pertanyaan No.1</label>
                <textarea name="soal[1][pertanyaan]" id="soal[1][pertanyaan]"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="" wfd-id="id2"></textarea>

                    @error('soal[1][pertanyaan]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="soal[1][pilihan][A]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">A.</label>
                <input type="text" name="soal[1][pilihan][A]" id="soal[1][pilihan][A]"
                    class="mb-4 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="" wfd-id="id2" >

                    @error('soal[1][pilihan][A]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <label for="soal[1][pilihan][B]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">B.</label>
                <input type="text" name="soal[1][pilihan][B]" id="soal[1][pilihan][B]"
                    class="mb-4 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="" wfd-id="id2" >

                    @error('soal[1][pilihan][B]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <label for="soal[1][pilihan][C]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">C.</label>
                <input type="text" name="soal[1][pilihan][C]" id="soal[1][pilihan][C]"
                    class="mb-4 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="" wfd-id="id2" >

                    @error('soal[1][pilihan][C]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <label for="soal[1][pilihan][D]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">D.</label>
                <input type="text" name="soal[1][pilihan][D]" id="soal[1][pilihan][D]"
                    class="mb-5 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="" wfd-id="id2" >

                    @error('soal[1][pilihan][D]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <label for="soal[1][jawaban_benar]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jawaban Benar</label>
                <select name="soal[1][jawaban_benar]" id="soal[1][jawaban_benar]" class="mb-5 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>

            </div>
            

            <div class="col-span-6 sm:col-span-3">
                <label for="soal[2][pertanyaan]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pertanyaan No.2</label>
                <textarea name="soal[2][pertanyaan]" id="soal[2][pertanyaan]"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    wfd-id="id2"></textarea>

                    @error('soal[2][pertanyaan]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="soal[2][pilihan][A]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">A.</label>
                <input type="text" name="soal[2][pilihan][A]" id="soal[2][pilihan][A]"
                    class="mb-4 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="" wfd-id="id2" >

                    @error('soal[2][pilihan][A]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <label for="soal[2][pilihan][B]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">B.</label>
                <input type="text" name="soal[2][pilihan][B]" id="soal[2][pilihan][B]"
                    class="mb-4 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="" wfd-id="id2" >

                    @error('soal[2][pilihan][B]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <label for="soal[2][pilihan][C]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">C.</label>
                <input type="text" name="soal[2][pilihan][C]" id="soal[2][pilihan][C]"
                    class="mb-4 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="" wfd-id="id2" >

                    @error('soal[2][pilihan][C]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <label for="soal[2][pilihan][D]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">D.</label>
                <input type="text" name="soal[2][pilihan][D]" id="soal[2][pilihan][D]"
                    class="mb-5 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="" wfd-id="id2" >

                    @error('soal[2][pilihan][D]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <label for="soal[2][jawaban_benar]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jawaban Benar</label>
                <select name="soal[2][jawaban_benar]" id="soal[2][jawaban_benar]" class="mb-5 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>

            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="soal[3][pertanyaan]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pertanyaan No.3</label>
                <textarea name="soal[3][pertanyaan]" id="soal[3][pertanyaan]"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    wfd-id="id2"></textarea>

                    @error('soal[3][pertanyaan]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

            </div>

            <div class="col-span-6 sm:col-span-3">
                <label for="soal[3][pilihan][A]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">A.</label>
                <input type="text" name="soal[3][pilihan][A]" id="soal[3][pilihan][A]"
                    class="mb-4 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="" wfd-id="id2" >

                    @error('soal[3][pilihan][A]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <label for="soal[3][pilihan][B]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">B.</label>
                <input type="text" name="soal[3][pilihan][B]" id="soal[3][pilihan][B]"
                    class="mb-4 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="" wfd-id="id2" >

                    @error('soal[3][pilihan][B]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <label for="soal[3][pilihan][C]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">C.</label>
                <input type="text" name="soal[3][pilihan][C]" id="soal[3][pilihan][C]"
                    class="mb-4 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="" wfd-id="id2" >

                    @error('soal[3][pilihan][C]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <label for="soal[3][pilihan][D]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">D.</label>
                <input type="text" name="soal[3][pilihan][D]" id="soal[3][pilihan][D]"
                    class="mb-5 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="" wfd-id="id2" >

                    @error('soal[3][pilihan][D]')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <label for="soal[3][jawaban_benar]"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jawaban Benar</label>
                <select name="soal[3][jawaban_benar]" id="soal[3][jawaban_benar]" class="mb-5 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>

            </div>
            
            <div class="col-span-6 sm:col-full">
                <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    type="submit" name="submit">
                    Simpan
                </button>
            </div>                    
        </div>
    </form>
</div>

@endsection