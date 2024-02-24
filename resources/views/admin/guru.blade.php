@extends('admin.layouts.layout')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
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
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Daftar Akun Guru</h1>
        </div>
        <div class="sm:flex">
            <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                <form class="lg:pr-3" action="{{ route('guru.search') }}" method="GET">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="flex items-center relative mt-1 lg:w-64 xl:w-96">
                        <input type="text" name="search" id="simple-search" class="bg-gray-50 border border-red-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Mencari nama guru" required>
                        <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-red-700 rounded-lg border border-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                <a type="button" href="{{ route('guru.create') }}" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 sm:w-auto dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Tambah akun
                </a>                
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                No.
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Nama
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Username
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                NUPTK
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Jenis Kelamin
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Tanggal Lahir
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                E-Mail
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                No HP
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($gurus as $index => $guru)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $index + 1 }}.</td>
                            <td class="flex items-center p-4 mr-12 space-x-6 whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-7 h-7 rounded-full">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                    <div class="text-base font-semibold text-gray-900 dark:text-white">{{ $guru->nama }}</div>
                                </div>
                            </td>
                            <td class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">{{ $guru->user->username }}</td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $guru->nik }}</td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $guru->jenis_kelamin }}</td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $guru->tanggal_lahir }}</td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $guru->email }}</td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $guru->nomor_hp }}</td>
                            <td class="p-4 space-x-2 whitespace-nowrap">
                                <a href="{{ route('guru.edit', $guru->idguru) }}">
                                    <button type="button" 
                                    class="open-modal-button inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900"
                                    data-idguru="{{ $guru->idguru }}">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                        Ubah
                                    </button>
                                </a>
                                
                                <button type="button" data-modal-toggle="delete-user-modal" data-guru-id="{{ $guru->idguru }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-red-600 bg-white rounded-lg hover:bg-gray-200 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900 border-red-600 border-2">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Hapus User Modal -->
@foreach($gurus as $guru)
<div class="fixed left-0 right-0 z-50 items-center justify-center hidden overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full" id="delete-user-modal">
    <div class="relative w-full h-full max-w-md px-4 md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex justify-end p-2">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white" data-modal-toggle="delete-user-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 pt-0 text-center">
                <svg class="w-16 h-16 mx-auto text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus akun ini?</h3>

                <form method="POST" action="{{ route('guru.destroy', $guru->idguru) }}"  
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                    Ya, saya yakin
                    </button>
                </form>
                
                <a href="#" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700" data-modal-toggle="delete-user-modal">
                    Tidak hapus
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mendapatkan elemen input tanggal
        const inputTanggal = document.getElementById('tgllahir');

        // Menambahkan event listener untuk memantau perubahan nilai pada input tanggal
        inputTanggal.addEventListener('change', function () {
            // Mendapatkan nilai input tanggal (format: yyyy-mm-dd)
            const tanggalIso = this.value;

            // Mengonversi tanggal ke format "y-m-d"
            const tanggalFormatted = new Date(tanggalIso).toISOString().split('T')[0];

            // Menetapkan nilai kembali ke input tanggal
            this.value = tanggalFormatted;
        });
    });
</script>

<!-- edit akun guru -->
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.querySelectorAll('.open-modal-button').forEach(button => {
            button.addEventListener('click', () => {
                const idguru = button.getAttribute('data-idguru');
                const form = document.querySelector('#send-form');
                form.action = `/editakunGuru/${idguru}`;
            });
        });
        $(document).ready(function() {
            // Tambahkan event click pada tombol "Edit user" di tabel
            $('button[data-modal-toggle="edit-user-modal"]').on('click', function() {
                // Dapatkan data dari baris tabel yang di-klik
                var row = $(this).closest('tr');
                var nama = row.find('td:nth-child(1)').text().trim();
                var nik = row.find('td:nth-child(2)').text().trim();
                var jenkel = row.find('td:nth-child(3)').text().trim();
                var tgllahir = row.find('td:nth-child(4)').text().trim();
                var email = row.find('td:nth-child(5)').text().trim();
                var nohp = row.find('td:nth-child(6)').text().trim();
                
                // Isi nilai-nilai tersebut ke dalam input fields pada modal edit
                $('#nama').val(nama);
                $('#nik').val(nik);
                $('#jenis_kelamin').val(jenkel);
                $('#tanggal_lahir').val(tgllahir);
                $('#email').val(email);
                $('#nomor_hp').val(nohp);
            });
        });
    </script>
@endsection

<!-- hapus akun guru -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteModal = document.getElementById('delete-user-modal');
        const deleteButtons = document.querySelectorAll('[data-modal-toggle="delete-user-modal"]');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const guruId = this.getAttribute('data-guru-id');
                const deleteForm = document.getElementById('delete-form');
                const actionUrl = deleteForm.getAttribute('action');

                // Update the form action with the guru ID
                deleteForm.setAttribute('action', actionUrl.replace('__guru_id__', guruId));

                // Show the delete modal
                deleteModal.classList.remove('hidden');
            });
        });

        // Add an event listener for the confirmation button
        const confirmButton = document.getElementById('confirm-delete-button');
        confirmButton.addEventListener('click', function () {
            // Perform the form submission
            const deleteForm = document.getElementById('delete-form');
            deleteForm.submit();
        });
    });
</script>

