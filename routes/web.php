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

// coba kuis pakai inertia
Route::get('/kuis', function () {
    return Inertia('Home');
});

Route::get('/questions', [QuestionController::class, 'index'])->name('questions');
Route::post('/questions', [QuestionController::class, 'store']);
Route::put('/questions', [QuestionController::class, 'update']);
Route::delete('/questions/{question}', [QuestionController::class, 'destroy']);
Route::put('/answers', [AnswerController::class, 'update']);

Route::get('/quiz', [QuizController::class, 'index']);
Route::post('/results', [QuizController::class, 'results']);

Route::fallback(function(){
    return Inertia('Home');
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


// Route::get('/akunGuru', function () {
//     return view('admin/guru');
// });

Route::get('/akunGuru', [AkunGuruController::class, 'index'])->name('guru.index');
Route::get('/editakunGuru', function () {
    return view('admin/editguru');
});
// Route::post('/akunGuru', [AkunGuruController::class, 'store'])->name('guru.store');

Route::get('/tambahakunGuru', [AkunGuruController::class, 'create'])->name('guru.create');
Route::post('/tambahakunGuru', [AkunGuruController::class, 'store'])->name('guru.store');

Route::get('/editakunGuru/{idguru}', [AkunGuruController::class, 'edit'])->name('guru.edit');
Route::post('/editakunGuru/{idguru}', [AkunGuruController::class, 'update'])->name('guru.update');

Route::delete('/akunGuru/{idguru}', [AkunGuruController::class, 'destroy'])->name('guru.destroy');

Route::get('/searchGuru', [AkunGuruController::class, 'search'])->name('guru.search');
// Route::get('/akunSiswa', function () {
//     return view('admin/siswa');
// });

Route::get('/akunSiswa', [AkunSiswaController::class, 'index'])->name('siswa.index');
Route::post('/akunSiswa', [AkunSiswaController::class, 'store'])->name('siswa.store');

Route::get('/editakunSiswa', function () {
    return view('admin/editsiswa');
});

Route::get('/tambahakunSiswa', [AkunSiswaController::class, 'create'])->name('siswa.create');
Route::post('/tambahakunSiswa', [AkunSiswaController::class, 'store'])->name('siswa.store');

Route::get('/editakunSiswa/{idsiswa}', [AkunSiswaController::class, 'edit'])->name('siswa.edit');
Route::post('/editakunSiswa/{idsiswa}', [AkunSiswaController::class, 'update'])->name('siswa.update');

Route::delete('/akunSiswa/{idsiswa}', [AkunSiswaController::class, 'destroy'])->name('siswa.destroy');

Route::get('/searchSiswa', [AkunSiswaController::class, 'search'])->name('siswa.search');

// guru
// Route::middleware(['auth'])->group(function () {
//     Route::get('/profilGuru', [GuruController::class, 'edit'])->name('edit2');
// });

Route::controller(GuruController::class)->middleware('auth')->group(function () {
    Route::get('/profilGuru', 'edit')->name('edit2');
    Route::get('/editprofilGuru', 'showEdit')->name('showEdit2');
    Route::post('/editprofilGuru', 'update')->name('update2');
});

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

Route::get('/kelasGuru', [KelasController::class, 'index'])->name('kelas.index');
Route::get('/tambahkelasGuru', [KelasController::class, 'create'])->name('kelas.create');
Route::post('/tambahkelasGuru', [KelasController::class, 'store'])->name('kelas.store');

Route::get('/editkelasGuru/{idkelas}', [KelasController::class, 'edit'])->name('kelas.edit');
Route::post('/editkelasGuru/{idkelas}', [KelasController::class, 'update'])->name('kelas.update');

Route::delete('/kelasGuru/{idkelas}', [KelasController::class, 'destroy'])->name('kelas.destroy');

Route::get('/masukKelas/{idkelas}', [TugasKuisController::class, 'index'])->name('tugaskuis.index');
Route::get('/tambahTugas/{idkelas}', [TugasKuisController::class, 'create'])->name('tugas.create');
Route::post('/tambahTugas', [TugasKuisController::class, 'store'])->name('tugas.store');
Route::get('/nilaiTugas/{idtugas}', [TugasKuisController::class, 'read'])->name('tugas.read');
Route::put('/nilaiTugas/{idpengumpulan}', [TugasKuisController::class, 'updateNilai'])->name('guru.updateNilai');
// Route::get('/cariSiswa', [TugasKuisController::class, 'search'])->name('tugas.search');
// Route::get('/nilaiTugas/sort/{idtugas}/{column}/{direction}', [TugasKuisController::class, 'sortNilai'])->name('tugas.sortNilai');
Route::get('/rekapTugas/{idtugas}', [TugasKuisController::class, 'downloadRekap'])->name('tugas.downloadRekap');
Route::get('/editTugas/{idtugas}', [TugasKuisController::class, 'edit'])->name('tugas.edit');
Route::post('/editTugas/{idtugas}', [TugasKuisController::class, 'update'])->name('tugas.update');
Route::delete('/masukKelas/{idkelas}/{idtugas}', [TugasKuisController::class, 'destroy'])->name('tugas.destroy');

// Route::get('/nilaiTugas/{idkelas}', [NilaiTugasController::class, 'index']);

Route::get('/tambahKuis/{idkelas}', [TugasKuisController::class, 'create2'])->name('kuis.create');
Route::post('/tambahKuis', [TugasKuisController::class, 'store2'])->name('kuis.store');
Route::get('/nilaiKuis/{idkuis}', [TugasKuisController::class, 'read3'])->name('kuis.read');
// Route::put('/nilaiKuis/{idkuis}', [TugasKuisController::class, 'updateNilai2'])->name('guru.updateNilai2');
Route::put('/nilaiKuis/{idkuis}', [TugasKuisController::class, 'updateNilai2'])->name('guru.updateNilai2');
Route::get('/nilaiKuis/{idkuis}/{idsiswa}', [TugasKuisController::class, 'lihatJawaban'])->name('guru.lihatJawaban');
Route::post('/simpanNilai', [TugasKuisController::class, 'simpanNilai'])->name('guru.simpanNilai');

Route::get('/editKuis/{idkuis}', [TugasKuisController::class, 'edit2'])->name('kuis.edit');
Route::post('/editKuis/{idkuis}', [TugasKuisController::class, 'update2'])->name('kuis.update');
Route::get('/tambahSoal/{idkuis}', [TugasKuisController::class, 'tambahSoal'])->name('kuis.tambahSoal');
Route::post('/tambahSoal', [TugasKuisController::class, 'storeSoal'])->name('kuis.storeSoal');
Route::get('/editSoalKuis/{idkuis}', [TugasKuisController::class, 'editSoal'])->name('kuis.editSoal');
Route::post('/editSoalKuis', [TugasKuisController::class, 'updateSoal'])->name('kuis.updateSoal');
Route::delete('/masukKelas/{idkelas}/{idkuis}', [TugasKuisController::class, 'destroy2'])->name('kuis.destroy');

// Route::get('/soalEsai', [EsaiController::class, 'index'])->name('esai.index');
// Route::get('/tambahEsai', [EsaiController::class, 'create'])->name('esai.create');
// Route::post('/tambahEsai', [EsaiController::class, 'store'])->name('esai.store');
// Route::get('/editEsai/{idesai}', [EsaiController::class, 'edit'])->name('esai.edit');
// Route::post('/editEsai/{idesai}', [EsaiController::class, 'update'])->name('esai.update');
// Route::delete('/soalEsai/{idesai}', [EsaiController::class, 'destroy'])->name('esai.destroy');

// Route::post('/masukKelas/siswa/{idkelas}', [TugasKuisController::class, 'create3'])->name('assign.siswa');
// Route::post('/undangSiswa/{idkelas}', [TugasKuisController::class, 'assignSiswa'])->name('assign.siswa');

Route::get('/undangSiswa/{idkelas}', [TugasKuisController::class, 'create3'])->name('enroll.create');
Route::post('/undangSiswa', [TugasKuisController::class, 'store3'])->name('enroll.store');
Route::get('/progresSiswa/{idsiswa}', [TugasKuisController::class, 'read2'])->name('progres.read');
Route::get('/rekapProgresSiswa/{idsiswa}', [TugasKuisController::class, 'rekapProgresSiswa'])->name('progres.rekap');



// Route::get('/tambahKuis/soalEsai', function () {
//     return view('guru/soalesai');
// });



Route::get('/viewMateri/{idkelas}', [MateriController::class, 'index'])->name('materi.index');
Route::get('/uploadMateri/{idkelas}', [MateriController::class, 'create'])->name('materi.create');
Route::post('/uploadMateri', [MateriController::class, 'store'])->name('materi.store');
Route::get('/readMateri/{idmateri}', [MateriController::class, 'read'])->name('materi.read');
Route::get('/editMateri/{idmateri}', [MateriController::class, 'edit'])->name('materi.edit');
Route::post('/editMateri/{idmateri}', [MateriController::class, 'update'])->name('materi.update');
Route::delete('/viewMateri/{idkelas}/{idmateri}', [MateriController::class, 'destroy'])->name('materi.destroy');

Route::get('/viewDiskusi/{idkelas}', [DiskusiController::class, 'index'])->name('diskusi.index');
Route::get('/tambahDiskusi/{idkelas}', [DiskusiController::class, 'create'])->name('diskusi.create');
Route::post('/tambahDiskusi', [DiskusiController::class, 'store'])->name('diskusi.store');
Route::get('/readDiskusi/{iddiskusi}', [DiskusiController::class, 'read'])->name('diskusi.read');
Route::get('/editDiskusi/{iddiskusi}', [DiskusiController::class, 'edit'])->name('diskusi.edit');
Route::post('/editDiskusi/{iddiskusi}', [DiskusiController::class, 'update'])->name('diskusi.update');
Route::delete('/viewDiskusi/{idkelas}/{iddiskusi}', [DiskusiController::class, 'destroy'])->name('diskusi.destroy');

Route::post('/tambahKomen', [CommentController::class, 'store'])->name('comments.store');
Route::post('/editKomen/{idcomment}', [CommentController::class, 'update'])->name('comments.update');
Route::post('/deleteKomen/{idcomment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Route::get('/progresSiswa/{idkelas}', [ProgresSiswaController::class, 'index'])->name('progressiswa.index');


//siswa
Route::get('/siswa/viewDiskusi/{idkelas}', [DiskusiController::class, 'index2'])->name('diskusi.index2');
Route::get('/siswa/readDiskusi/{iddiskusi}', [DiskusiController::class, 'read2'])->name('diskusi.read2');
Route::get('/siswa/viewMateri/{idkelas}', [MateriController::class, 'index2'])->name('materi.index2');
Route::get('/siswa/readMateri/{idmateri}', [MateriController::class, 'read2'])->name('materi.read2');

// Route::get('/nilaiTugas', function () {
//     return view('guru/nilaitugas');
// });

Route::get('/nilaiKuis', function () {
    return view('guru/nilaikuis');
});
Route::get('/diskusiMat', function () {
    return view('guru/diskusi');
});
// Route::get('/progresMat', function () {
//     return view('guru/progres');
// });
Route::get('/progresKelasMat', function () {
    return view('guru/rekapkelas');
});

// siswa
Route::controller(SiswaController::class)->middleware('auth')->group(function () {
    Route::get('/profilSiswa', 'edit')->name('edit3');
    Route::get('/editprofilSiswa', 'showEdit')->name('showEdit3');
    Route::post('/editprofilSiswa', 'update')->name('update3');
});

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
Route::get('/dasborSiswa', [DasborSiswaController::class, 'index'])->name('dasborsiswa.index');

Route::get('/kelasSiswa', [KelasSiswaController::class, 'index'])->name('siswakelas.index');

// Route::get('/kelasMatematika', function () {
//     return view('siswa/mat');
// });

Route::get('/masukKelasSiswa/{idkelas}', [MasukKelasSiswaController::class, 'index'])->name('siswamasuk.index');
Route::get('/detailTugas/{idtugas}', [MasukKelasSiswaController::class, 'read'])->name('siswamasuk.read');
Route::get('/kumpulTugas/{idtugas}', [MasukKelasSiswaController::class, 'create'])->name('kumpultugas.create');
Route::post('/kumpulTugas', [MasukKelasSiswaController::class, 'store'])->name('kumpultugas.store');
Route::get('/editkumpulTugas/{idtugas}', [MasukKelasSiswaController::class, 'edit'])->name('kumpultugas.edit');
Route::post('/editkumpulTugas/{idtugas}', [MasukKelasSiswaController::class, 'update'])->name('kumpultugas.update');

Route::get('/detailKuis/{idkuis}', [MasukKelasSiswaController::class, 'read2'])->name('siswakuis.read');
Route::get('/kumpulKuis/{idkuis}', [MasukKelasSiswaController::class, 'create2'])->name('kumpulkuis.create');
Route::post('/kumpulKuis', [MasukKelasSiswaController::class, 'store2'])->name('kumpulkuis.store');
Route::get('/editkumpulKuis/{idkuis}', [MasukKelasSiswaController::class, 'edit2'])->name('kumpulkuis.edit');
Route::post('/editkumpulKuis/{idkuis}', [MasukKelasSiswaController::class, 'update2'])->name('kumpulkuis.update');

Route::get('/rekapTugasKuis/{idkelas}', [MasukKelasSiswaController::class, 'downloadRekapTugas'])->name('siswamasuk.rekapTugas');


// Route::get('/detailKuis/{idkuis}', [TugasKuisController::class, 'detailKuis'])->name('siswa.detailkuis');
Route::get('/kerjakanKuis/{idkuis}', [TugasKuisController::class, 'kerjakanKuis'])->name('siswa.kerjakankuis');
// Route::get('/tugasMatematika', function () {
//     return view('siswa/mattugas');
// });

Route::get('/diskusiMatematika', function () {
    return view('siswa/diskusi');
});