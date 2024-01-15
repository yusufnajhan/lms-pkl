@extends('admin.layouts.layout')
@section('content')
<div class="mb-4">
    <nav class="flex mb-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
          <li class="inline-flex items-center">
            <a href="/akunGuru"
                class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>                                                                                                                                                                                        
                <span class="ml-3" sidebar-toggle-item="">Akun Guru</span>
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
              <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Ubah Akun Guru</span>
            </div>
          </li>
        </ol>
    </nav>
    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Akun Guru</h1>
</div>

    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6"> 
            <div class="text-center text-gray-500 dark:text-gray-400">
                <img class="mx-auto mb-4 w-36 h-36 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="Bonnie Avatar">
            </div>
            <div class="col-span-6 sm:col-full">
                <a href="/editprofilAdmin"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    type="submit">
                    Ubah foto profil
                </a>

            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form action="#">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="idguru" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Guru</label>
                            <input type="number" name="idguru" id="idguru" value="{{ $idguru }}" class="shadow-sm bg-gray-50 bordr border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" disabled>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" name="nama" value="Bonnie" id="nama" value="{{ $nama }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="nuptk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NUPTK</label>
                            <input type="number" name="nuptk" value="121212121" id="nuptk" value="{{ $nik }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="jenkel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                            <select name="jenkel" id="jenkel" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                <option value="pria" {{ $jenis_kelamin == 'pria' ? 'selected' : '' }}>Pria</option>
                                <option value="wanita" {{ $jenis_kelamin == 'wanita' ? 'selected' : '' }}>Wanita</option>
                            </select>
                        </div>                        
                        <div class="col-span-6 sm:col-span-3">
                            <label for="tgllahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
                            <input type="date" name="tgllahir" id="tgllahir" value="{{ $tanggal_lahir }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>  
                        <div class="col-span-6 sm:col-span-3">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-Mail</label>
                            <input type="email" name="email" id="email" value="{{ $email }}" class="shadow-sm bg-gray-50 bordr border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="nohp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No HP</label>
                            <input type="number" name="nohp" id="nohp" value="{{ $nomor_hp }}" class="shadow-sm bg-gray-50 bordr border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                        </div>  
                        <div class="col-span-6 sm:col-span-3">
                            <label for="iduser" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID User</label>
                            <input type="number" name="iduser" id="iduser" value="{{ $iduser }}" class="shadow-sm bg-gray-50 bordr border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" disabled>
                        </div>
                        {{-- <div class="col-span-6 sm:col-span-3">
                            <label for="mapel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mata pelajaran</label>
                            <select name="mapel" id="mapel" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                <option value="PAI">PAI dan Budi Pekerti</option>
                                <option value="Mat">Matematika</option>
                                <option value="Ingg">Bahasa Indonesia</option>
                                <option value="Indo">Bahasa Indonesia</option>
                                <option value="PKN">PKN</option>
                                <option value="IPAS">IPAS</option>
                                <option value="IPS">IPS</option>
                                <option value="IF">Informatika</option>
                                <option value="Prak">Prakarya</option>
                                <option value="PJOK">PJOK</option>
                            </select>
                        </div> --}}
                    </div> 
                    <!-- Modal footer -->
                    <div class="items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                        <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- <form action="{{ route('admin.editprofil') }}" method="POST"> --}}
            @csrf
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="nama"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input type="text" name="nama" id="nama"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="" wfd-id="id1" >
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="kode"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NUPTK</label>
                    <input type="text" name="kode" id="kode"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="" wfd-id="id2" >
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="jenkel"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                    <input type="text" name="jenkel" id="jenkel"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="" wfd-id="id2" >
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="lahir"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
                    <input type="date" name="lahir" id="lahir"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="" wfd-id="id2" >
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-Mail</label>
                    <input type="email" name="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="" wfd-id="id2" >
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="nohp"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No HP</label>
                    <input type="number" name="nohp" id="nohp"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="" wfd-id="id2" >
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="username"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" name="username" id="username"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="" wfd-id="id6" >
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="current_password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata sandi saat ini</label>
                    <input type="password" name="current_password" id="current_password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        value="" >
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kata sandi baru</label>
                    <input data-popover-target="popover-password" data-popover-placement="bottom" type="password"
                        id="new_password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                         >
                    <div data-popover="" id="popover-password" role="tooltip"
                        class="absolute z-10 invisible inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400"
                        style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(680px, -1808.67px, 0px);"
                        data-popper-placement="top">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Must have at least 6 characters
                            </h3>
                            <div class="grid grid-cols-4 gap-2">
                                <div class="h-1 bg-orange-300 dark:bg-orange-400"></div>
                                <div class="h-1 bg-orange-300 dark:bg-orange-400"></div>
                                <div class="h-1 bg-gray-200 dark:bg-gray-600"></div>
                                <div class="h-1 bg-gray-200 dark:bg-gray-600"></div>
                            </div>
                            <p>It’s better to have:</p>
                            <ul>
                                <li class="flex items-center mb-1">
                                    <svg class="w-4 h-4 mr-2 text-green-400 dark:text-green-500" aria-hidden="true"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Upper &amp; lower case letters
                                </li>
                                <li class="flex items-center mb-1">
                                    <svg class="w-4 h-4 mr-2 text-gray-300 dark:text-gray-400" aria-hidden="true"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    A symbol (#$&amp;)
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-300 dark:text-gray-400" aria-hidden="true"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    A longer password (min. 12 chars.)
                                </li>
                            </ul>
                        </div>
                        <div data-popper-arrow=""
                            style="position: absolute; left: 0px; transform: translate3d(139.333px, 0px, 0px);"></div>
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="new_confirm_password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi kata sandi baru</label>
                    <input type="password" name="new_confirm_password" id="new_confirm_password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        >
                </div>
                <div class="col-span-6 sm:col-full">
                    <a href="/akunGuru"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                        type="submit">
                        Simpan
                    </a>
                </div>                       
            </div>
        {{-- </form> --}}
        
    </div>
@endsection