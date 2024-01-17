<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AkunGuruController;
use App\Http\Controllers\AkunSiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;

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

// login dan dasbor
Route::controller(LoginController::class)->group(function (){
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});


Route::controller(DashboardController::class)->middleware('auth')->group(function () {
    Route::get('/berandaGuru', 'viewDashboardGuru');
    Route::get('/berandaSiswa', 'viewDashboardSiswa');
    Route::get('/berandaAdmin', 'viewDashboardAdmin');
});



// admin
Route::controller(AdminController::class)->middleware('auth')->group(function () {
    Route::get('/profilAdmin', 'edit');
});
// Route::get('/profilAdmin', [AdminController::class, 'profil']);

// Route::get('/profilAdmin', function () {
//     return view('admin/profil');
// });

Route::get('/editprofilAdmin', [AdminController::class, 'editprofil'])->name('admin.editprofil');
Route::post('/profilAdmin', [AdminController::class, 'updateprofil'])->name('admin.profil');

// Route::get('/editprofilAdmin', function () {
//     return view('admin/editprofil');
// });

// Route::get('/akunGuru', function () {
//     return view('admin/guru');
// });

Route::get('/akunGuru', [AkunGuruController::class, 'index'])->name('guru.index');
Route::get('/editakunGuru', function () {
    return view('admin/editguru');
});
Route::post('/akunGuru', [AkunGuruController::class, 'store'])->name('guru.store');

Route::get('/editakunGuru/{idguru}', [AkunGuruController::class, 'edit'])->name('guru.edit');
Route::post('/editakunGuru/{idguru}', [AkunGuruController::class, 'update'])->name('guru.update');

Route::delete('/akunGuru/{idguru}', [AkunGuruController::class, 'destroy'])->name('guru.destroy');

// Route::get('/akunSiswa', function () {
//     return view('admin/siswa');
// });

Route::get('/akunSiswa', [AkunSiswaController::class, 'index'])->name('siswa.index');
Route::post('/akunSiswa', [AkunSiswaController::class, 'store'])->name('siswa.store');

Route::get('/editakunSiswa', function () {
    return view('admin/editsiswa');
});

Route::get('/editakunSiswa/{idsiswa}', [AkunSiswaController::class, 'edit'])->name('siswa.edit');
Route::post('/editakunSiswa/{idsiswa}', [AkunSiswaController::class, 'update'])->name('siswa.update');

Route::delete('/akunSiswa/{idsiswa}', [AkunSiswaController::class, 'destroy'])->name('siswa.destroy');


// guru
// Route::middleware(['auth'])->group(function () {
//     Route::get('/profilGuru', [GuruController::class, 'edit'])->name('edit2');
// });

Route::controller(GuruController::class)->middleware('auth')->group(function () {
    Route::get('/profilGuru', 'edit');
});

// Route::get('/profilGuru', function () {
//     return view('guru/profil');
// });
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
Route::controller(SiswaController::class)->middleware('auth')->group(function () {
    Route::get('/profilSiswa', 'edit');
});
// Route::get('/profilSiswa', function () {
//     return view('siswa/profil');
// });
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