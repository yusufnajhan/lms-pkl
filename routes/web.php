<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function (){
    return view('login');
});

// admin
Route::get('/berandaAdmin', [AdminController::class, 'beranda']);

Route::get('/profilAdmin', [AdminController::class, 'profil']);

// Route::get('/profilAdmin', function () {
//     return view('admin/profil');
// });

Route::get('/editprofilAdmin', [AdminController::class, 'editprofil'])->name('admin.editprofil');
Route::post('/profilAdmin', [AdminController::class, 'updateprofil'])->name('admin.profil');

// Route::get('/editprofilAdmin', function () {
//     return view('admin/editprofil');
// });

Route::get('/akunGuru', function () {
    return view('admin/guru');
});
Route::get('/akunSiswa', function () {
    return view('admin/siswa');
});


// guru
Route::get('/berandaGuru', function () {
    return view('guru/beranda');
});
Route::get('/profilGuru', function () {
    return view('guru/profil');
});
Route::get('/editprofilGuru', function () {
    return view('guru/editprofil');
});
// Route::get('/murid', function () {
//     return view('guru/murid');
// });
Route::get('/kelasGuru', function () {
    return view('guru/kelas');
});
Route::get('/kelasMat', function () {
    return view('guru/mat');
});
Route::get('/tugasMat', function () {
    return view('guru/nilaitugas');
});
Route::get('/kuisMat', function () {
    return view('guru/nilaikuis');
});
Route::get('/diskusiMat', function () {
    return view('guru/diskusi');
});
Route::get('/progresMat', function () {
    return view('guru/progres');
});
Route::get('/progresKelasMat', function () {
    return view('guru/rekapkelas');
});

// siswa
Route::get('/berandaSiswa', function () {
    return view('siswa/beranda');
});
Route::get('/profilSiswa', function () {
    return view('siswa/profil');
});
Route::get('/editprofilSiswa', function () {
    return view('siswa/editprofil');
});
Route::get('/dasborSiswa', function () {
    return view('siswa/dasbor');
});
// Route::get('/guruteman', function () {
//     return view('siswa/guruteman');
// });
Route::get('/kelasSiswa', function () {
    return view('siswa/kelas');
});
Route::get('/kelasMatematika', function () {
    return view('siswa/mat');
});
Route::get('/tugasMatematika', function () {
    return view('siswa/mattugas');
});
Route::get('/kuisMatematika', function () {
    return view('siswa/matkuis');
});
Route::get('/diskusiMatematika', function () {
    return view('siswa/diskusi');
});