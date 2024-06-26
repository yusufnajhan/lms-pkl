<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\Pengumpulan_Tugas;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Jawaban_Kuis;
use App\Models\Pengumpulan_Kuis;
use App\Models\Soal_Kuis;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

class TugasKuisController extends Controller
{
    // read
    public function index($idkelas)
    {
        $kelas = Kelas::findOrFail($idkelas);
        $tugass = Tugas::where('idkelas', $idkelas)->get();
        $kuiss = Kuis::where('idkelas', $idkelas)->get();
        $enrollments = Enrollment::with('siswa')->where('idkelas', $idkelas)->get();
        return view('guru.masukKelas', compact('kelas','tugass','kuiss','enrollments'));
    }
    
    public function create($idkelas)
    {
        $kelass = Kelas::findOrFail($idkelas);
        // $kelass = Kelas::pluck('idkelas', 'idkelas');
        return view('guru.tambahTugas', compact('kelass'));
    }

    public function create2($idkelas)
    {
        $kelas = Kelas::findOrFail($idkelas);
        // $kelass = Kelas::pluck('idkelas', 'idkelas');
        return view('guru.tambahKuis', compact('kelas'));
    }

    public function create3($idkelas)
    {
        $kelas = Kelas::findOrFail($idkelas);
        // $kelass = Kelas::pluck('idkelas', 'idkelas');
        // $siswas = Siswa::pluck('idsiswa', 'idsiswa');
        // $siswas = Siswa::all();
        // Mengambil semua idsiswa yang sudah diundang ke kelas ini
        $idsiswaUndangan = Enrollment::where('idkelas', $idkelas)->pluck('idsiswa');

        // Mengambil semua siswa yang belum diundang ke kelas ini
        $siswas = Siswa::whereNotIn('idsiswa', $idsiswaUndangan)->get();
        return view('guru.undangSiswa', compact('kelas','siswas'));
    }

    // public function create3($idkelas)
    // {
    //     // Menggunakan ID kelas dari parameter URL
    //     $kelas = Kelas::find($idkelas);

    //     // Dapatkan siswa yang belum di-assign ke kelas
    //     $siswasBelumDiAssign = Siswa::whereDoesntHave('enrollments', function ($query) use ($idkelas) {
    //         $query->where('idkelas', $idkelas);
    //     })->get();

    //     return view('guru.masukKelas', compact('kelas', 'siswasBelumDiAssign'));
    // }

    // undang siswa
    // public function assignSiswa(Request $request, $idkelas)
    // {
    //     // Validasi form jika diperlukan
    //     $request->validate([
    //         'idsiswa' => 'required|exists:siswa,idsiswa',
    //     ]);

    //     // Cek apakah siswa sudah di-assign ke kelas tersebut
    //     $enrollmentExists = Enrollment::where('idkelas', $idkelas)
    //         ->where('idsiswa', $request->idsiswa)
    //         ->exists();

    //     if (!$enrollmentExists) {
    //         // Jika belum di-assign, tambahkan ke tabel enrollment
    //         Enrollment::create([
    //             'idkelas' => $idkelas,
    //             'idsiswa' => $request->idsiswa,
    //             'tanggal_enroll' => now(), // Sesuaikan dengan kebutuhan
    //         ]);

    //         return redirect()->route('route.name')->with('success', 'Siswa berhasil di-assign ke kelas.');
    //     } else {
    //         return redirect()->route('route.name')->with('error', 'Siswa sudah di-assign ke kelas tersebut.');
    //     }
    // }

    // add tugas
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            // 'idtugas' => 'required|numeric',
            'judul_tugas' => 'required',
            'deskripsi_tugas' => 'required',
            'file_tugas' => 'required|file|max:25600',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'idkelas' => 'required|numeric',
        ]);
        $idkelas = $request->input('idkelas');

        if ($request->file('file_tugas')) {
            $file_tugas = $request->file('file_tugas')->store('file_tugas', 'public');
        }

        DB::beginTransaction();
        try 
        {
            // Simpan data tugas ke dalam database
            Tugas::create([
                // 'idtugas' => $request->input('idtugas'),
                'judul_tugas' => $request->input('judul_tugas'),
                'deskripsi_tugas' => $request->input('deskripsi_tugas'),
                'file_tugas' => $file_tugas,
                'tanggal_mulai' => $request->input('tanggal_mulai'),
                'tanggal_selesai' => $request->input('tanggal_selesai'),
                'idkelas' => $request->input('idkelas'),
            ]);

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('tugaskuis.index', $idkelas)->with('success', 'Tugas baru berhasil ditambahkan.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('tugaskuis.index', $idkelas)
                ->with(['error' => 'Gagal menambah tugas baru. Error: ' . $e->getMessage()]);
        }
    }

    // menampilkan siswa yang sudah mengumpulkan tugas
    public function read(Request $request, int $idtugas)
    {
        $search = $request->input('search');

        $tugas = Tugas::where('idtugas', $idtugas)->first();
        $kelas = Kelas::where('idkelas', $tugas->idkelas)->first();

        // Get the task submissions for the specific task
        // $pengumpulanTugas = Pengumpulan_Tugas::where('idtugas', $idtugas)->with('siswa')->get();

        $pengumpulanTugas = Pengumpulan_Tugas::where('idtugas', $idtugas)
        ->when($search, function ($query, $search) {
            $query->whereHas('siswa', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            });
        })
        ->with('siswa')
        ->get();

        // Hitung jumlah siswa yang telah mengumpulkan tugas
        $jumlahPengumpulan = $pengumpulanTugas->count();

        // Hitung jumlah total siswa dalam kelas
        $totalSiswa = $kelas->siswas()->count();

        // Hitung jumlah siswa yang belum mengumpulkan tugas
        $belumMengumpulkan = $totalSiswa - $jumlahPengumpulan;

        // Hitung nilai tertinggi yang diperoleh siswa
        $nilaiTertinggi = $pengumpulanTugas->max('nilai');

        // Hitung nilai terendah yang diperoleh siswa
        $nilaiTerendah = $pengumpulanTugas->min('nilai');

        // Hitung nilai rata-rata yang diperoleh siswa
        $nilaiRata = $pengumpulanTugas->avg('nilai');

        return view('guru.nilaiTugas', compact('tugas', 'kelas', 'pengumpulanTugas',
                'jumlahPengumpulan','belumMengumpulkan','nilaiTertinggi','nilaiTerendah','nilaiRata'));
    }

    // $pengumpulanKuis = Jawaban_Kuis::where('jawaban_kuis.idkuis', $idkuis)
        //     ->join('siswa', 'jawaban_kuis.idsiswa', '=', 'siswa.idsiswa')
        //     ->leftJoin('pengumpulan_kuis', function($join) use ($idkuis) {
        //         $join->on('siswa.idsiswa', '=', 'pengumpulan_kuis.idsiswa')
        //             ->where('pengumpulan_kuis.idkuis', '=', $idkuis);
        //     })
        //     ->select('siswa.idsiswa', 'siswa.nama', 'siswa.nik', 'pengumpulan_kuis.nilai')
        //     ->when($search, function ($query, $search) {
        //         $query->where('siswa.nama', 'like', '%' . $search . '%');
        //     })
        //     ->groupBy('siswa.idsiswa', 'siswa.nama', 'siswa.nik', 'pengumpulan_kuis.nilai')
        //     ->get();

    // menampilkan siswa yang sudah mengumpulkan kuis 
    public function read3(Request $request, int $idkuis)
    {
        $search = $request->input('search');

        $kuis = Kuis::where('idkuis', $idkuis)->first();
        $kelas = Kelas::where('idkelas', $kuis->idkelas)->first();

        $pengumpulanKuis = Jawaban_Kuis::where('idkuis', $idkuis)
        ->when($search, function ($query, $search) {
            $query->whereHas('siswa', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            });
        })
        ->with('siswa')
        ->groupBy('idsiswa')
        ->selectRaw('idsiswa, MAX(nilai) as nilai')
        ->get();

        // Hitung jumlah siswa yang telah mengumpulkan tugas
        $jumlahPengumpulan = $pengumpulanKuis->count();

        // Hitung jumlah total siswa dalam kelas
        $totalSiswa = $kelas->siswas()->count();

        // Hitung jumlah siswa yang belum mengumpulkan tugas
        $belumMengumpulkan = $totalSiswa - $jumlahPengumpulan;

        // Hitung nilai tertinggi yang diperoleh siswa
        $nilaiTertinggi = $pengumpulanKuis->max('nilai');

        // Hitung nilai terendah yang diperoleh siswa
        $nilaiTerendah = $pengumpulanKuis->min('nilai');

        // Hitung nilai rata-rata yang diperoleh siswa
        $nilaiRata = $pengumpulanKuis->avg('nilai');

        // Ubah nilai null menjadi "belum dinilai"
        $pengumpulanKuis->transform(function ($item) {
            $item->nilai = $item->nilai ?? 'belum dinilai';
            return $item;
        });

        return view('guru.nilaikuis', compact('kuis', 'kelas', 'pengumpulanKuis',
                'jumlahPengumpulan','belumMengumpulkan','nilaiTertinggi','nilaiTerendah','nilaiRata'));
    }


    // guru bisa memberi nilai tugas
    public function updateNilai(Request $request, $idpengumpulan)
    {
        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        try {
            $pengumpulan = Pengumpulan_Tugas::find($idpengumpulan);
            $pengumpulan->nilai = $request->nilai;
            $pengumpulan->save();

            return back()->with('success', 'Berhasil memperbarui nilai tugas.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui nilai tugas.');
        }
    }

    // guru bisa memberi nilai kuis
    // public function updateNilai2(Request $request, $idkuis)
    // {
    //     $request->validate([
    //         'nilai' => 'required|integer|min:0|max:100',
    //     ]);

    //     try {
    //         $pengumpulan = Jawaban_Kuis::where('idkuis', $idkuis)->get();
    //         foreach ($pengumpulan as $jawaban) {
    //             $jawaban->nilai = $request->nilai;
    //             $jawaban->save();
    //         }

    //         return back()->with('success', 'Berhasil memperbarui nilai kuis.');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Gagal memperbarui nilai kuis.');
    //     }
    // }
    // public function updateNilai2(Request $request, $idkuis)
    // {
    //     $request->validate([
    //         'nilai' => 'required|integer|min:0|max:100',
    //     ]);

    //     try {
    //         // Ambil semua pengumpulan kuis untuk kuis tertentu
    //         $pengumpulan = Pengumpulan_Kuis::where('idkuis', $idkuis)->get();
            
    //         // Iterasi melalui setiap pengumpulan kuis dan perbarui nilainya
    //         foreach ($pengumpulan as $pengumpulan) {
    //             $pengumpulan->nilai = $request->nilai;
    //             $pengumpulan->save();
    //         }

    //         return back()->with('success', 'Berhasil memperbarui nilai kuis.');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Gagal memperbarui nilai kuis.');
    //     }
    // }

    // public function updateNilai2(Request $request, $idkuis)
    // {
    //     $request->validate([
    //         'nilai' => 'required|integer|min:0|max:100',
    //     ]);

    //     try {
    //         // Ambil semua pengumpulan kuis untuk kuis tertentu
    //         $pengumpulan = Pengumpulan_Kuis::where('idkuis', $idkuis)->get();
            
    //         // Iterasi melalui setiap pengumpulan kuis dan perbarui nilainya
    //         foreach ($pengumpulan as $item) {
    //             // Temukan atau buat entri pengumpulan kuis untuk siswa dan kuis yang sesuai
    //             $pengumpulanKuis = Pengumpulan_Kuis::firstOrNew([
    //                 'idkuis' => $idkuis,
    //                 'idsiswa' => $item->idsiswa,
    //             ]);
                
    //             // Set nilai kuis dan simpan perubahan
    //             $pengumpulanKuis->nilai = $request->nilai;
    //             $pengumpulanKuis->save();
    //         }

    //         return back()->with('success', 'Berhasil memperbarui nilai kuis.');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Gagal memperbarui nilai kuis.');
    //     }
    // }

    // public function updateNilai2(Request $request, $idpengumpulan)
    // {
    //     $request->validate([
    //         'nilai' => 'required|integer|min:0|max:100',
    //     ]);

    //     try {
    //         $pengumpulan = Pengumpulan_Kuis::find($idpengumpulan);
    //         $pengumpulan->nilai = $request->nilai;
    //         $pengumpulan->save();

    //         return back()->with('success', 'Berhasil memperbarui nilai kuis.');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Gagal memperbarui nilai kuis.');
    //     }
    // }

    // public function updateNilai2(Request $request, $idkuis)
    // {
    //     $request->validate([
    //         'nilai' => 'required|integer|min:0|max:100',
    //         'idsiswa' => 'required|exists:siswa,idsiswa',
    //     ]);

    //     try {
    //         $pengumpulan = Pengumpulan_Kuis::where('idkuis', $idkuis)
    //             ->where('idsiswa', $request->idsiswa)
    //             ->firstOrFail();
    //         $pengumpulan->nilai = $request->nilai;
    //         $pengumpulan->save();

    //         return back()->with('success', 'Berhasil memperbarui nilai kuis.');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Gagal memperbarui nilai kuis.');
    //     }
    // }

    public function updateNilai2(Request $request, $idpengumpulan)
    {
        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        try {
            $pengumpulan = Pengumpulan_Kuis::findOrFail($idpengumpulan);
            $pengumpulan->nilai = $request->nilai;
            $pengumpulan->save();

            return back()->with('success', 'Berhasil memperbarui nilai kuis.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui nilai kuis.');
        }
    }




    // guru liat jawaban kuis tiap siswa
    // public function lihatJawaban($idkuis, $idsiswa)
    // {
    //     $jawaban = Jawaban_Kuis::where('idkuis', $idkuis)->where('idsiswa', $idsiswa)->get();
    //     $kuis = Kuis::find($idkuis);
    //     $kelas = Enrollment::where('idsiswa', $idsiswa)->first()->kelas;

    //     return view('guru.jawabanKuis', ['jawaban' => $jawaban, 'kuis' => $kuis, 'kelas' => $kelas]);
    // }

    public function lihatJawaban($idkuis, $idsiswa)
    {
        $jawaban = Jawaban_Kuis::where('idkuis', $idkuis)->where('idsiswa', $idsiswa)->get();
        $kuis = Kuis::find($idkuis);
        $kelas = Enrollment::where('idsiswa', $idsiswa)->first()->kelas;

        // Ambil nilai dari jawaban kuis (misalnya dari kolom 'nilai')
        $nilai = $jawaban->first()->nilai;

        return view('guru.jawabanKuis', [
            'jawaban' => $jawaban,
            'kuis' => $kuis,
            'kelas' => $kelas,
            'idsiswa' => $idsiswa, // Tambahkan variabel ini
            'idkuis' => $idkuis, // Tambahkan variabel ini
            'nilai' => $nilai, // Tambahkan variabel ini
        ]);
    }


    public function simpanNilai(Request $request)
    {
        $idsiswa = $request->input('idsiswa');
        $idkuis = $request->input('idkuis');
        $nilai = $request->input('nilai');

        // Validasi nilai (harus berada dalam rentang 0-100)
        if ($nilai < 0 || $nilai > 100) {
            return redirect()->back()->with('error', 'Nilai harus berada dalam rentang 0 hingga 100.');
        }

        // Simpan nilai untuk jawaban pertama
        $jawabanPertama = Jawaban_Kuis::where('idsiswa', $idsiswa)
            ->where('idkuis', $idkuis)
            ->first();

        if ($jawabanPertama) {
            $jawabanPertama->nilai = $nilai;
            $jawabanPertama->save();
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan nilai kuis.');
        }

        // Set nilai untuk jawaban lain dengan idsiswa dan idkuis yang sama
        $jawabanLain = Jawaban_Kuis::where('idsiswa', $idsiswa)
            ->where('idkuis', $idkuis)
            ->where('idjawaban', '!=', $jawabanPertama->idjawaban) // Exclude jawaban pertama
            ->get();

        foreach ($jawabanLain as $jawaban) {
            $jawaban->nilai = $nilai;
            $jawaban->save();
        }

        return redirect()->back()->with('success', 'Berhasil menyimpan nilai kuis.');
    }


    // cari nama siswa di progres tiap tugas
    public function search(Request $request) 
    {
        $search = $request->input('search');
        $siswas = Siswa::all();

        if (!empty($search)) {
            $siswas = Siswa::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })->get();
        }

        return view('guru.nilaiTugas', ['siswas' => $siswas]);
    }

    // cari nama siswa di progres tiap kuis
    public function search2(Request $request) 
    {
        $search = $request->input('search');
        $siswas = Siswa::all();

        if (!empty($search)) {
            $siswas = Siswa::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })->get();
        }

        return view('guru.nilaiKuis', ['siswas' => $siswas]);
    }

    // sorting nilai tugas
    public function sortNilai($idtugas, $column, $direction)
    {
        $tugas = Tugas::sortable()->findOrFail($idtugas);
        $kelas = Kelas::sortable()->findOrFail($tugas->idkelas);

        // Ambil data pengumpulan tugas dengan sorting
        $pengumpulanTugas = Pengumpulan_Tugas::where('idtugas', $idtugas)
            ->orderBy($column, $direction)
            ->with('siswa')
            ->get();

        return view('guru.nilaiTugas', compact('tugas', 'kelas', 'pengumpulanTugas'));
    }


    // download rekap setiap tugas
    public function downloadRekap($idtugas)
    {
        $tugas = Tugas::where('idtugas', $idtugas)->first();
        $kelas = Kelas::where('idkelas', $tugas->idkelas)->first();
        $pengumpulanTugas = Pengumpulan_Tugas::where('idtugas', $idtugas)->with('siswa')->get();

        // Hitung nilai tertinggi yang diperoleh siswa
        $nilaiTertinggi = $pengumpulanTugas->max('nilai');

        // Hitung nilai terendah yang diperoleh siswa
        $nilaiTerendah = $pengumpulanTugas->min('nilai');

        // Hitung nilai rata-rata yang diperoleh siswa
        $nilaiRata = $pengumpulanTugas->avg('nilai');

        $pdf = FacadePdf::loadView('guru.rekapTugas', compact('tugas', 'kelas', 'pengumpulanTugas','nilaiTertinggi','nilaiTerendah','nilaiRata'));
        return $pdf->download('rekap_tugas.pdf');
    }


    // add kuis
    public function store2(Request $request)
    {
        // Validasi data input
        $request->validate([
            // 'idkuis' => 'required|numeric',
            'judul_kuis' => 'required',
            'deskripsi_kuis' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'jumlah_soal' => 'required|numeric',
            'idkelas' => 'required|numeric',
            
        ]);
        $idkelas = $request->input('idkelas');

        // $jumlah_soal = $request->input('jumlah_soal');

        DB::beginTransaction();
        try 
        {
            // Simpan data kuis ke dalam database
            Kuis::create([
                // 'idkuis' => $request->input('idkuis'),
                'judul_kuis' => $request->input('judul_kuis'),
                'deskripsi_kuis' => $request->input('deskripsi_kuis'),
                'tanggal_mulai' => $request->input('tanggal_mulai'),
                'tanggal_selesai' => $request->input('tanggal_selesai'),
                'jumlah_soal' => $request->input('jumlah_soal'),
                'idkelas' => $request->input('idkelas'),
                
            ]);

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('tugaskuis.index', $idkelas)->with('success', 'Kuis baru berhasil ditambahkan.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('tugaskuis.index', $idkelas)
                ->with(['error' => 'Gagal menambah kuis baru. Error: ' . $e->getMessage()]);
        }
    }

    // download rekap setiap kuis
    public function downloadRekapKuis($idkuis)
    {
        $kuis = Kuis::where('idkuis', $idkuis)->first();
        $kelas = Kelas::where('idkelas', $kuis->idkelas)->first();
        $pengumpulanKuis = Jawaban_Kuis::where('idkuis', $idkuis)->with('siswa')
        ->with('siswa')
        ->groupBy('idsiswa')
        ->selectRaw('idsiswa, MAX(nilai) as nilai')
        ->get();

        // Hitung nilai tertinggi yang diperoleh siswa
        $nilaiTertinggi = $pengumpulanKuis->max('nilai');

        // Hitung nilai terendah yang diperoleh siswa
        $nilaiTerendah = $pengumpulanKuis->min('nilai');

        // Hitung nilai rata-rata yang diperoleh siswa
        $nilaiRata = $pengumpulanKuis->avg('nilai');

        $pdf = FacadePdf::loadView('guru.rekapKuis', compact('kuis', 'kelas', 'pengumpulanKuis','nilaiTertinggi','nilaiTerendah','nilaiRata'));
        return $pdf->download('rekap_kuis.pdf');
    }

    // undang siswa
    public function store3(Request $request)
    {
        // Validasi data input
        $request->validate([
            // 'idenroll' => 'required|numeric',
            'tanggal_enroll' => 'required',
            // 'idsiswa' => 'required|numeric',
            'nama' => 'required|string',
            'idkelas' => 'required|numeric',
        ]);
        $idkelas = $request->input('idkelas');

        // mencari idsiswa berdasarkan nama
        $nama = $request->input('nama');
        $siswa = Siswa::where('nama', $nama)->first();

        if (!$siswa) {
            return redirect()
                ->route('tugaskuis.index', $idkelas)
                ->with(['error' => 'Siswa dengan nama tersebut tidak ditemukan.']);
        }

        $idsiswa = $siswa->idsiswa;


        // Memeriksa apakah siswa sudah diundang pada kelas yang sama
        $existingEnrollment = Enrollment::where('idsiswa', $request->input('idsiswa'))
            ->where('idkelas', $request->input('idkelas'))
            ->first();

        if ($existingEnrollment) {
            return redirect()
                ->route('tugaskuis.index', ['idkelas' => $request->input('idkelas')])
                ->with(['error' => 'Siswa sudah diundang pada kelas yang sama.']);
        }

        DB::beginTransaction();
        try 
        {
            // Simpan data enrollment ke dalam database
            Enrollment::create([
                // 'idenroll' => $request->input('idenroll'),
                'tanggal_enroll' => $request->input('tanggal_enroll'),
                // 'idsiswa' => $request->input('idsiswa'),
                'idsiswa' => $idsiswa,
                'idkelas' => $request->input('idkelas'),
            ]);

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('tugaskuis.index', $idkelas)
                ->with('success', 'Siswa berhasil diundang.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('tugaskuis.index', $idkelas)
                ->with(['error' => 'Gagal mengundang siswa. Error: ' . $e->getMessage()]);
        }
    }

    // progres siswa
    public function read2(int $idsiswa)
    {
        // Dapatkan siswa berdasarkan id
        $siswa = Siswa::findOrFail($idsiswa);

        // Dapatkan objek kelas dari objek siswa
        $kelas = $siswa->kelas()->first();  
    
        // Dapatkan idkelas dari objek siswa
        $idkelas = $siswa->kelas()->first()->idkelas;
    
        // Dapatkan semua tugas yang telah dikumpulkan siswa tersebut pada kelas tersebut
        $tugasDikumpulkan = Pengumpulan_Tugas::where('idsiswa', $idsiswa)
            ->whereHas('tugas', function ($query) use ($idkelas) {
                $query->where('idkelas', $idkelas);
            })
            ->where('status', 1)
            ->with('tugas')
            ->get();
    
        // Dapatkan semua tugas untuk kelas tersebut
        $semuaTugas = Tugas::where('idkelas', $idkelas)->get();
    
        // Dapatkan id tugas yang telah dikumpulkan
        $idTugasDikumpulkan = $tugasDikumpulkan->pluck('tugas.idtugas');
    
        // Filter tugas yang belum dikumpulkan oleh siswa
        $tugasBelumDikumpulkan = $semuaTugas->whereNotIn('idtugas', $idTugasDikumpulkan);

        // Dapatkan semua kuis yang telah dikumpulkan siswa tersebut pada kelas tersebut
        $kuisDikumpulkan = Jawaban_Kuis::where('idsiswa', $idsiswa)
        ->whereHas('kuis', function ($query) use ($idkelas) {
            $query->where('idkelas', $idkelas);
        })
        ->where('status', 1)
        ->with('kuis')
        ->groupBy('idkuis')
        ->selectRaw('idkuis, MAX(nilai) as nilai')
        ->get();

        // Dapatkan semua kuis untuk kelas tersebut
        $semuaKuis = Kuis::where('idkelas', $idkelas)->get();

        // Dapatkan id kuis yang telah dikumpulkan
        $idKuisDikumpulkan = $kuisDikumpulkan->pluck('kuis.idkuis');

        // Filter kuis yang belum dikumpulkan oleh siswa
        $kuisBelumDikumpulkan = $semuaKuis->whereNotIn('idkuis', $idKuisDikumpulkan);
    
        return view('guru.progres', compact('siswa', 'tugasDikumpulkan', 'tugasBelumDikumpulkan','kelas', 'kuisDikumpulkan', 'kuisBelumDikumpulkan'));
    }
    
    // rekap progres siswa pdf
    public function rekapProgresSiswa(int $idsiswa)
    {
        // Dapatkan siswa berdasarkan id
        $siswa = Siswa::findOrFail($idsiswa);
    
        // Dapatkan idkelas dari objek siswa
        $idkelas = $siswa->kelas()->first()->idkelas;
    
        // Dapatkan semua tugas yang telah dikumpulkan siswa tersebut pada kelas tersebut
        $tugasDikumpulkan = Pengumpulan_Tugas::where('idsiswa', $idsiswa)
            ->whereHas('tugas', function ($query) use ($idkelas) {
                $query->where('idkelas', $idkelas);
            })
            ->where('status', 1)
            ->with('tugas')
            ->get();
    
        // Dapatkan semua tugas untuk kelas tersebut
        $semuaTugas = Tugas::where('idkelas', $idkelas)->get();
    
        // Dapatkan id tugas yang telah dikumpulkan
        $idTugasDikumpulkan = $tugasDikumpulkan->pluck('tugas.idtugas');
    
        // Filter tugas yang belum dikumpulkan oleh siswa
        $tugasBelumDikumpulkan = $semuaTugas->whereNotIn('idtugas', $idTugasDikumpulkan);

        // Dapatkan semua kuis yang telah dikumpulkan siswa tersebut pada kelas tersebut
        $kuisDikumpulkan = Jawaban_Kuis::where('idsiswa', $idsiswa)
        ->whereHas('kuis', function ($query) use ($idkelas) {
            $query->where('idkelas', $idkelas);
        })
        ->where('status', 1)
        ->with('kuis')
        ->groupBy('idkuis')
        ->selectRaw('idkuis, MAX(nilai) as nilai')
        ->get();

        // Dapatkan semua kuis untuk kelas tersebut
        $semuaKuis = Kuis::where('idkelas', $idkelas)->get();

        // Dapatkan id kuis yang telah dikumpulkan
        $idKuisDikumpulkan = $kuisDikumpulkan->pluck('kuis.idkuis');

        // Filter kuis yang belum dikumpulkan oleh siswa
        $kuisBelumDikumpulkan = $semuaKuis->whereNotIn('idkuis', $idKuisDikumpulkan);
   
        // Buat PDF
        $pdf = FacadePdf::loadView('guru.rekapProgres', compact('siswa', 'tugasDikumpulkan', 'tugasBelumDikumpulkan', 'kuisDikumpulkan', 'kuisBelumDikumpulkan'));
        return $pdf->download('rekap_progres_siswa.pdf');
    }

    // edit tugas
    public function edit(int $idtugas)
    {
        $tugas = Tugas::where('idtugas', $idtugas)->first();

        // $judul_tugas = $tugas->judul_tugas;
        // $deskripsi_tugas = $tugas->deskripsi_tugas;
        // $file_tugas = $tugas->file_tugas;
        // $tanggal_mulai = $tugas->tanggal_mulai;
        // $tanggal_selesai = $tugas->tanggal_selesai;
        // $idkelas = $tugas->idkelas;

        // $kelass = Kelas::pluck('idkelas', 'idkelas');
        $kelas = Kelas::where('idkelas', $tugas->idkelas)->first();

        // return view("guru.edittugas", compact('idtugas','judul_tugas', 'deskripsi_tugas','file_tugas', 'tanggal_mulai', 'tanggal_selesai'
        //                                     ,'idkelas','kelass'));
        return view("guru.edittugas", compact('tugas','kelas'));
    }

    public function update(Request $request, int $idtugas)
    {
        $request->validate([
            'judul_tugas' => 'required',
            'deskripsi_tugas' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'file_tugas' => 'file|max:25600',
        ]);
        $idkelas = $request->input('idkelas');

        if ($request->file('file_tugas')) {
            Storage::disk('public')->delete($request->input('oldFile'));
            $file_tugas = $request->file('file_tugas')->store('file_tugas', 'public');
        }

        DB::beginTransaction();
        try {
            Tugas::where('idtugas', $idtugas)->update([
                'judul_tugas' => $request->input('judul_tugas'),
                'deskripsi_tugas' => $request->input('deskripsi_tugas'),
                'tanggal_mulai' => $request->input('tanggal_mulai'),
                'tanggal_selesai' => $request->input('tanggal_selesai'),
            ]);
            if (isset($file_tugas)) {
                Tugas::where('idtugas', $idtugas)->update([
                    'file_tugas' => $file_tugas
                ]);
            }

            DB::commit();

            return redirect()
                ->route('tugaskuis.index', $idkelas)
                ->with('success', 'Tugas berhasil diperbarui.');

        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('tugaskuis.index', $idkelas)
                ->withErrors(['error' => 'Gagal memperbarui tugas. Error: ' . $e->getMessage()]);
        }
    }

    // edit kuis
    public function edit2(Request $request, $idkuis)
    {
        $kuis = Kuis::where('idkuis', $idkuis)->first();
        $kelas = Kelas::where('idkelas', $kuis->idkelas)->first();

        $judul_kuis = $kuis->judul_kuis;
        $deskripsi_kuis = $kuis->deskripsi_kuis;
        $tanggal_mulai = $kuis->tanggal_mulai;
        $tanggal_selesai = $kuis->tanggal_selesai;
        $idkelas = $kuis->idkelas;


        return view("guru.editkuis", compact('idkuis','judul_kuis', 'deskripsi_kuis', 'tanggal_mulai', 'tanggal_selesai'
                                            ,'idkelas','kelas'));
    }

    // buat soal isian di tiap kuis
    public function tambahSoal($idkuis)
    {
        $kuis = Kuis::findOrFail($idkuis);
        return view('guru.buatSoal', compact('kuis'));
    }

    public function storeSoal(Request $request)
    {
        $request->validate([
            'soal.*' => 'required',
            'jawaban.*' => 'required',
        ]);

        $soal = $request->input('soal');
        $jawaban = $request->input('jawaban');
        $idkuis = $request->input('idkuis');
        for ($i = 0; $i < count($soal); $i++) {
            Soal_Kuis::create([
                'pertanyaan' => $soal[$i],
                'jawaban' => $jawaban[$i],
                'idkuis' => $idkuis,
            ]);
        }
        $idkelas = Kuis::find($idkuis)->idkelas;

        return redirect()->route('tugaskuis.index', $idkelas)->with('success', 'Soal berhasil ditambahkan.');
    }

    // edit soal setiap kuis
    public function editSoal($idkuis)
    {
        $kuis = Kuis::findOrFail($idkuis);
        $soal_kuis = Soal_Kuis::where('idkuis', $idkuis)->get();
        return view('guru.editSoalKuis', compact('kuis', 'soal_kuis'));
    }

    public function updateSoal(Request $request)
    {
        $request->validate([
            'soal.*' => 'required',
            'jawaban.*' => 'required',
        ]);

        $soal = $request->input('soal');
        $jawaban = $request->input('jawaban');
        $idkuis = $request->input('idkuis');
        for ($i = 0; $i < count($soal); $i++) {
            $soal_kuis = Soal_Kuis::where('idkuis', $idkuis)->get()[$i];
            $soal_kuis->pertanyaan = $soal[$i];
            $soal_kuis->jawaban = $jawaban[$i];
            $soal_kuis->save();
        }

        $idkelas = Kuis::find($idkuis)->idkelas;

        return redirect()->route('tugaskuis.index', $idkelas)->with('success', 'Soal kuis berhasil diperbarui.');
    }


    // public function tambahSoal(Request $request, $idkuis)
    // {
    //     $kuis = Kuis::where('idkuis', $idkuis)->first();
    //     $kelas = Kelas::where('idkelas', $kuis->idkelas)->first();

    //     $jumlah_soal = $kuis->jumlah_soal;

    //     return view("guru.tambahsoal", compact('kuis', 'kelas','jumlah_soal'));
    // }

    // public function storeSoal(Request $request, $idkuis)
    // {
    //     $validated = $request->validate([
    //         'soal.*.pertanyaan' => 'required',
    //         'soal.*.pilihan.A' => 'required',
    //         'soal.*.pilihan.B' => 'required',
    //         'soal.*.pilihan.C' => 'required',
    //         'soal.*.pilihan.D' => 'required',
    //         'soal.*.jawaban_benar' => 'required',
    //     ]); 

    //     $kuis = Kuis::where('idkuis', $idkuis)->first();

    //     foreach ($request->soal as $index => $soal) {
    //         $soalBaru = Question::create([
    //             'question' => $soal['pertanyaan'],
    //             'idkuis' => $kuis->idkuis,
    //         ]);
    
    //         foreach ($soal['pilihan'] as $huruf => $pilihan) {
    //             $isCorrect = ($huruf === $soal['jawaban_benar']) ? 1 : 0;
    //             Answer::create([
    //                 'choice' => $huruf,
    //                 'answer' => $pilihan,
    //                 'question_id' => $soalBaru->id,
    //                 'correct_answer' => $isCorrect,
    //                 // tambahkan field lain jika ada
    //             ]);
    //         }
    //     }
    
    //     return back()->with('success', 'Soal dan jawaban berhasil disimpan.');


    // }

    public function detailKuis($idkuis)
    {
        $kuis = Kuis::where('idkuis', $idkuis)->first();
        $kelas = Kelas::where('idkelas', $kuis->idkelas)->first();

        return view('siswa.detailKuis', compact('kuis', 'kelas'));
    }

    public function kerjakanKuis($idkuis)
    {
        $kuis = Kuis::where('idkuis', $idkuis)->first();
        $kelas = Kelas::where('idkelas', $kuis->idkelas)->first();

        return view('siswa.kerjakanKuis', compact('kuis', 'kelas'));

    }

    public function submitKuis(Request $request, $idkuis)
    {
        // $kuis = Kuis::where('idkuis', $idkuis)->first();
        // $kelas = Kelas::where('idkelas', $kuis->idkelas)->first();

        // $submission = $request->input('jawaban');
        // $questions = Question::where('kuis_id', $idkuis)->with('correctAnswer')->get();
    
        // $score = 0;
    
        // foreach ($questions as $question) {
        //     if (isset($submittedAnswers[$question->id]) && $submittedAnswers[$question->id] == $question->correctAnswer->choice) {
        //         $score++;
        //     }
        // }
    
        // $totalQuestions = count($questions);
        // $percentageScore = ($score / $totalQuestions) * 100;
    
        // return back()->with('success', "Skor Anda: $score/$totalQuestions ($percentageScore%)");


    }

    public function update2(Request $request, $idkuis)
    {
        $validated = $request->validate([
            'judul_kuis' => 'required',
            'deskripsi_kuis' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'idkelas' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            Kuis::where('idkuis', $idkuis)->update($validated);
            DB::commit();

            return redirect()
                ->route('tugaskuis.index', ['idkelas' => $request->idkelas])
                ->with('success', 'kuis berhasil diperbarui.');

        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('tugaskuis.index', ['idkelas' => $request->idkelas])
                ->withErrors(['error' => 'Gagal memperbarui kuis. Error: ' . $e->getMessage()]);
        }
    }

    // delete tugas
    public function destroy($idkelas, $idtugas)
    {
        DB::beginTransaction();

        try {
            // $tugas = Tugas::where('idtugas', $idtugas);
            $tugas = Tugas::where('idtugas', $idtugas)->first();

            $file_tugas = $tugas->file_tugas;
            $idkelas = $tugas->idkelas;
            $tugas->delete();
    
            DB::commit();

            Storage::disk('public')->delete($file_tugas);
    
            return redirect()
                ->route('tugaskuis.index', ['idkelas' => $idkelas])
                ->with('success', 'Tugas berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()
                ->route('tugaskuis.index', ['idkelas' => $idkelas])
                ->withErrors(['error' => 'Gagal menghapus tugas. Error: ' . $e->getMessage()]);
        }
    }

    // delete kuis
    // public function destroy2($idkelas, $idkuis)
    // {
    //     DB::beginTransaction();

    //     try {
    //         // Hapus semua soal yang terkait dengan kuis ini
    //         // Soal_Kuis::where('idkuis', $idkuis)->delete();

    //         // Kemudian hapus kuisnya
    //         $kuis = Kuis::where('idkuis', $idkuis)->first();
    //         $idkelas = $kuis->idkelas;
    //         $kuis->delete();

    //         DB::commit();

    //         return redirect()
    //             ->route('tugaskuis.index', ['idkelas' => $idkelas])
    //             ->with('success', 'Kuis berhasil dihapus.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         return redirect()
    //             ->route('tugaskuis.index', ['idkelas' => $idkelas])
    //             ->withErrors(['error' => 'Gagal menghapus kuis. Error: ' . $e->getMessage()]);
    //     }
    // }
    public function destroy2($idkelas, $idkuis)
    {
        DB::beginTransaction();

        try {
            // Hapus semua data jawaban kuis yang terkait dengan kuis tertentu
            Jawaban_Kuis::where('idkuis', $idkuis)->delete();

            // Hapus semua data soal kuis yang terkait dengan kuis tertentu
            Soal_Kuis::where('idkuis', $idkuis)->delete();

            // Kemudian hapus kuis itu sendiri
            $kuis = Kuis::find($idkuis);
            $idkelas = $kuis->idkelas;
            $kuis->delete();

            DB::commit();

            return redirect()
                ->route('tugaskuis.index', ['idkelas' => $idkelas])
                ->with('success', 'Kuis berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('tugaskuis.index', ['idkelas' => $idkelas])
                ->withErrors(['error' => 'Gagal menghapus kuis. Error: ' . $e->getMessage()]);
        }
    }




    // // delete siswa
    // public function destroy3($idenroll)
    // {
    //     DB::beginTransaction();

    //     try {
    //         Enrollment::where('idenroll', $idenroll)->delete();
    
    //         DB::commit();
    
    //         return redirect()
    //             ->route('tugaskuis.index')
    //             ->with('success', 'Siswa berhasil dihapus.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    
    //         return redirect()
    //             ->route('tugaskuis.index')
    //             ->withErrors(['error' => 'Gagal menghapus siswa. Error: ' . $e->getMessage()]);
    //     }
    // }

    // delete siswa
    // public function destroy3($idenroll)
    // {
    //     try {
    //         DB::beginTransaction();

    //         // Retrieve the idkelas before deleting the enrollment record
    //         $enrollment = Enrollment::where('idenroll', $idenroll)->first();

    //         if (!$enrollment) {
    //             // Handle the case where the enrollment record is not found
    //             DB::rollBack();
    //             return redirect()
    //                 ->route('tugaskuis.index')
    //                 ->withErrors(['error' => 'Enrollment record not found.']);
    //         }

    //         $idkelas = $enrollment->idkelas;

    //         Enrollment::where('idenroll', $idenroll)->delete();

    //         DB::commit();

    //         // Redirect to tugaskuis.index with the required idkelas parameter
    //         return redirect()
    //             ->route('tugaskuis.index', ['idkelas' => $idkelas])
    //             ->with('success', 'Siswa berhasil dihapus.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         $idkelas = $enrollment->idkelas;

    //         return redirect()
    //             ->route('tugaskuis.index', ['idkelas' => $idkelas])
    //             ->withErrors(['error' => 'Gagal menghapus siswa. Error: ' . $e->getMessage()]);
    //     }
    // }

}
