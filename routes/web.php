<?php

use App\Http\Controllers\MateriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AkunGuruController;
use App\Http\Controllers\AkunSiswaController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\EsaiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\MasukKelasController;
use App\Http\Controllers\NilaiTugasController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\TugasKuisController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DasborSiswaController;
use App\Http\Controllers\KelasSiswaController;
use App\Http\Controllers\MasukKelasSiswaController;
use App\Http\Controllers\ProgresSiswaController;
use Inertia\Inertia;

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
    Route::get('/profilAdmin', 'edit')->name('edit1');
    Route::get('/editprofilAdmin', 'showEdit')->name('showEdit1');
    Route::post('/editprofilAdmin', 'update')->name('update1');
});

Route::controller(AkunGuruController::class)->middleware('auth')->group(function () {
    Route::get('/akunGuru','index')->name('guru.index');
    Route::get('/tambahakunGuru', 'create')->name('guru.create');
    Route::post('/tambahakunGuru', 'store')->name('guru.store');

    Route::get('/editakunGuru/{idguru}', 'edit')->name('guru.edit');
    Route::post('/editakunGuru/{idguru}', 'update')->name('guru.update');

    Route::delete('/akunGuru/{idguru}', 'destroy')->name('guru.destroy');

    Route::get('/searchGuru', 'search')->name('guru.search');

    Route::get('/akunSiswa', 'index')->name('siswa.index');
    Route::post('/akunSiswa', 'store')->name('siswa.store');

});

Route::controller(AkunSiswaController::class)->middleware('auth')->group(function () {
    Route::get('/tambahakunSiswa', 'create')->name('siswa.create');
    Route::post('/tambahakunSiswa', 'store')->name('siswa.store');

    Route::get('/editakunSiswa/{idsiswa}', 'edit')->name('siswa.edit');
    Route::post('/editakunSiswa/{idsiswa}', 'update')->name('siswa.update');

    Route::delete('/akunSiswa/{idsiswa}', 'destroy')->name('siswa.destroy');

    Route::get('/searchSiswa', 'search')->name('siswa.search');
});



// Route::get('/akunGuru', function () {
//     return view('admin/guru');
// });
// Route::get('/akunSiswa', function () {
//     return view('admin/siswa');
// });
// Route::get('/editakunSiswa', function () {
//     return view('admin/editsiswa');
// });

// Route::get('/editakunGuru', function () {
//     return view('admin/editguru');
// });
// Route::post('/akunGuru', [AkunGuruController::class, 'store'])->name('guru.store');



// guru
Route::controller(GuruController::class)->middleware('auth')->group(function () {
    Route::get('/profilGuru', 'edit')->name('edit2');
    Route::get('/editprofilGuru', 'showEdit')->name('showEdit2');
    Route::post('/editprofilGuru', 'update')->name('update2');
});

Route::controller(KelasController::class)->middleware('auth')->group(function () {
    Route::get('/kelasGuru' , 'index')->name('kelas.index');
    Route::get('/tambahkelasGuru' , 'create')->name('kelas.create');
    Route::post('/tambahkelasGuru' , 'store')->name('kelas.store');
    
    Route::get('/editkelasGuru/{idkelas}' , 'edit')->name('kelas.edit');
    Route::post('/editkelasGuru/{idkelas}' , 'update')->name('kelas.update');
    
    Route::delete('/kelasGuru/{idkelas}' , 'destroy')->name('kelas.destroy');
});

Route::controller(TugasKuisController::class)->middleware('auth')->group(function () {
    Route::get('/masukKelas/{idkelas}' , 'index')->name('tugaskuis.index');
    Route::get('/tambahTugas/{idkelas}' , 'create')->name('tugas.create');
    Route::post('/tambahTugas' , 'store')->name('tugas.store');
    Route::get('/nilaiTugas/{idtugas}' , 'read')->name('tugas.read');
    Route::put('/nilaiTugas/{idpengumpulan}' , 'updateNilai')->name('guru.updateNilai');
    Route::get('/rekapTugas/{idtugas}' , 'downloadRekap')->name('tugas.downloadRekap');
    Route::get('/editTugas/{idtugas}' , 'edit')->name('tugas.edit');
    Route::post('/editTugas/{idtugas}' , 'update')->name('tugas.update');
    Route::delete('/masukKelas/{idkelas}/{idtugas}' , 'destroy')->name('tugas.destroy');
    Route::get('/tambahKuis/{idkelas}' , 'create2')->name('kuis.create');
    Route::post('/tambahKuis' , 'store2')->name('kuis.store');
    Route::get('/editKuis/{idkuis}' , 'edit2')->name('kuis.edit');
    Route::post('/editKuis/{idkuis}' , 'update2')->name('kuis.update');
    Route::get('/tambahSoal/{idkuis}' , 'tambahSoal')->name('kuis.tambahSoal');
    Route::post('/tambahSoal/{idkuis}' , 'storeSoal')->name('kuis.storeSoal');
    Route::delete('/masukKelas/kuis/{idkuis}' , 'destroy2')->name('kuis.destroy');
    Route::get('/undangSiswa/{idkelas}' , 'create3')->name('enroll.create');
    Route::post('/undangSiswa' , 'store3')->name('enroll.store');
    Route::get('/progresSiswa/{idsiswa}' , 'read2')->name('progres.read');
    Route::get('/rekapProgresSiswa/{idsiswa}' , 'rekapProgresSiswa')->name('progres.rekap');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/profilGuru', [GuruController::class, 'edit'])->name('edit2');
// });
// Route::get('/profilGuru', function () {
//     return view('guru/profil');
// });
// Route::get('/editprofilGuru', function () {
//     return view('guru/editprofil');
// });
// Route::get('/murid', function () {
//     return view('guru/murid');
// });
// Route::get('/kelasGuru', function () {
//     return view('guru/kelas');
// });
// Route::get('/tambahkelasGuru', function () {
//     return view('guru/tambahkelas');
// });
// Route::get('/cariSiswa', [TugasKuisController::class, 'search'])->name('tugas.search');
// Route::get('/nilaiTugas/sort/{idtugas}/{column}/{direction}', [TugasKuisController::class, 'sortNilai'])->name('tugas.sortNilai');
// Route::get('/nilaiTugas/{idkelas}', [NilaiTugasController::class, 'index']);
// Route::get('/soalEsai', [EsaiController::class, 'index'])->name('esai.index');
// Route::get('/tambahEsai', [EsaiController::class, 'create'])->name('esai.create');
// Route::post('/tambahEsai', [EsaiController::class, 'store'])->name('esai.store');
// Route::get('/editEsai/{idesai}', [EsaiController::class, 'edit'])->name('esai.edit');
// Route::post('/editEsai/{idesai}', [EsaiController::class, 'update'])->name('esai.update');
// Route::delete('/soalEsai/{idesai}', [EsaiController::class, 'destroy'])->name('esai.destroy');

// Route::post('/masukKelas/siswa/{idkelas}', [TugasKuisController::class, 'create3'])->name('assign.siswa');
// Route::post('/undangSiswa/{idkelas}', [TugasKuisController::class, 'assignSiswa'])->name('assign.siswa');
// Route::get('/tambahKuis/soalEsai', function () {
//     return view('guru/soalesai');
// });

Route::controller(MateriController::class)->middleware('auth')->group(function () {
    Route::get('/viewMateri/{idkelas}', 'index')->name('materi.index');
    Route::get('/uploadMateri/{idkelas}', 'create')->name('materi.create');
    Route::post('/uploadMateri', 'store')->name('materi.store');
    Route::get('/readMateri/{idmateri}', 'read')->name('materi.read');
    Route::get('/editMateri/{idmateri}', 'edit')->name('materi.edit');
    Route::post('/editMateri/{idmateri}', 'update')->name('materi.update');
    Route::delete('/viewMateri/{idkelas}/{idmateri}', 'destroy')->name('materi.destroy');
});

Route::controller(DiskusiController::class)->middleware('auth')->group(function () {
    Route::get('/viewDiskusi/{idkelas}', [DiskusiController::class, 'index'])->name('diskusi.index');
    Route::get('/tambahDiskusi/{idkelas}', [DiskusiController::class, 'create'])->name('diskusi.create');
    Route::post('/tambahDiskusi', [DiskusiController::class, 'store'])->name('diskusi.store');
    Route::get('/readDiskusi/{iddiskusi}', [DiskusiController::class, 'read'])->name('diskusi.read');
    Route::get('/editDiskusi/{iddiskusi}', [DiskusiController::class, 'edit'])->name('diskusi.edit');
    Route::post('/editDiskusi/{iddiskusi}', [DiskusiController::class, 'update'])->name('diskusi.update');
    Route::delete('/viewDiskusi/{idkelas}/{iddiskusi}', [DiskusiController::class, 'destroy'])->name('diskusi.destroy');
});

Route::controller(DiskusiController::class)->middleware('auth')->group(function () {
    Route::post('/tambahKomen', 'store')->name('comments.store');
    Route::post('/editKomen/{idcomment}', 'update')->name('comments.update');
    Route::post('/deleteKomen/{idcomment}', 'destroy')->name('comments.destroy');
});



// Route::get('/progresSiswa/{idkelas}', [ProgresSiswaController::class, 'index'])->name('progressiswa.index');



//siswa
Route::controller(TugasKuisController::class)->middleware('auth')->group(function () {
    Route::get('/detailKuis/{idkuis}', 'detailKuis')->name('siswa.detailkuis');
    Route::get('/kerjakanKuis/{idkuis}', 'kerjakanKuis')->name('siswa.kerjakankuis');
});

Route::controller(DiskusiController::class)->middleware('auth')->group(function () {
    Route::get('/siswa/viewDiskusi/{idkelas}', 'index2')->name('diskusi.index2');
    Route::get('/siswa/readDiskusi/{iddiskusi}', 'read2')->name('diskusi.read2');
});
Route::controller(MateriController::class)->middleware('auth')->group(function () {
    Route::get('/siswa/viewMateri/{idkelas}', 'index2')->name('materi.index2');
    Route::get('/siswa/readMateri/{idmateri}', 'read2')->name('materi.read2');
});

Route::controller(SiswaController::class)->middleware('auth')->group(function () {
    Route::get('/profilSiswa', 'edit')->name('edit3');
    Route::get('/editprofilSiswa', 'showEdit')->name('showEdit3');
    Route::post('/editprofilSiswa', 'update')->name('update3');
});

Route::controller(MasukKelasSiswaController::class)->middleware('auth')->group(function () {
    Route::get('/masukKelasSiswa/{idkelas}'::class, 'index')->name('siswamasuk.index');
    Route::get('/detailTugas/{idtugas}'::class, 'read')->name('siswamasuk.read');
    Route::get('/kumpulTugas/{idtugas}'::class, 'create')->name('kumpultugas.create');
    Route::post('/kumpulTugas'::class, 'store')->name('kumpultugas.store');
    Route::get('/editkumpulTugas/{idtugas}'::class, 'edit')->name('kumpultugas.edit');
    Route::post('/editkumpulTugas/{idtugas}'::class, 'update')->name('kumpultugas.update');
    Route::get('/rekapTugasKuis/{idkelas}'::class, 'downloadRekapTugas')->name('siswamasuk.rekapTugas');
});

Route::get('/dasborSiswa', [DasborSiswaController::class, 'index'])->name('dasborsiswa.index');
Route::get('/kelasSiswa', [KelasSiswaController::class, 'index'])->name('siswakelas.index');

// Route::get('/nilaiTugas', function () {
//     return view('guru/nilaitugas');
// });

// Route::get('/nilaiKuis', function () {
//     return view('guru/nilaikuis');
// });
// Route::get('/diskusiMat', function () {
//     return view('guru/diskusi');
// });
// Route::get('/progresMat', function () {
//     return view('guru/progres');
// });
// Route::get('/progresKelasMat', function () {
//     return view('guru/rekapkelas');
// });


// Route::get('/profilSiswa', function () {
//     return view('siswa/profil');
// });
// Route::get('/editprofilSiswa', function () {
//     return view('siswa/editprofil');
// });
// Route::get('/dasborSiswa', function () {
//     return view('siswa/dasbor');
// });
// Route::get('/guruteman', function () {
//     return view('siswa/guruteman');
// });
// Route::get('/kelasSiswa', function () {
//     return view('siswa/kelas');
// });


// Route::get('/kelasMatematika', function () {
//     return view('siswa/mat');
// });


// Route::get('/tugasMatematika', function () {
//     return view('siswa/mattugas');
// });

// Route::get('/diskusiMatematika', function () {
//     return view('siswa/diskusi');
// });


// // coba kuis pakai inertia
// Route::get('/kuis', function () {
//     return Inertia('Home');
// });
// Route::get('/questions', [QuestionController::class, 'index'])->name('questions');
// Route::post('/questions', [QuestionController::class, 'store']);
// Route::put('/questions', [QuestionController::class, 'update']);
// Route::delete('/questions/{question}', [QuestionController::class, 'destroy']);
// Route::put('/answers', [AnswerController::class, 'update']);

// Route::get('/quiz', [QuizController::class, 'index']);
// Route::post('/results', [QuizController::class, 'results']);

// Route::fallback(function(){
//     return Inertia('Home');
// });