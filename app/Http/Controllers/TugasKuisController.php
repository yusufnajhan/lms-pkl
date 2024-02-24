<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\Pengumpulan_Tugas;
use App\Models\Siswa;
use App\Models\Tugas;
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
        $siswas = Siswa::pluck('idsiswa', 'idsiswa');
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
            'idtugas' => 'required|numeric',
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
                'idtugas' => $request->input('idtugas'),
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
    public function read(int $idtugas)
    {
        $tugas = Tugas::where('idtugas', $idtugas)->first();
        $kelas = Kelas::where('idkelas', $tugas->idkelas)->first();

        // Get the task submissions for the specific task
        $pengumpulanTugas = Pengumpulan_Tugas::where('idtugas', $idtugas)->with('siswa')->get();

        return view('guru.nilaiTugas', compact('tugas', 'kelas', 'pengumpulanTugas'));
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

    // download rekap setiap tugas
    public function downloadRekap($idtugas)
    {
        $tugas = Tugas::where('idtugas', $idtugas)->first();
        $kelas = Kelas::where('idkelas', $tugas->idkelas)->first();
        $pengumpulanTugas = Pengumpulan_Tugas::where('idtugas', $idtugas)->with('siswa')->get();

        $pdf = FacadePdf::loadView('guru.rekapTugas', compact('tugas', 'kelas', 'pengumpulanTugas'));
        return $pdf->download('rekap_tugas.pdf');
    }


    // add kuis
    public function store2(Request $request)
    {
        // Validasi data input
        $request->validate([
            'idkuis' => 'required|numeric',
            'judul_kuis' => 'required',
            'deskripsi_kuis' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'idkelas' => 'required|numeric',
        ]);
        $idkelas = $request->input('idkelas');

        DB::beginTransaction();
        try 
        {
            // Simpan data kuis ke dalam database
            Kuis::create([
                'idkuis' => $request->input('idkuis'),
                'judul_kuis' => $request->input('judul_kuis'),
                'deskripsi_kuis' => $request->input('deskripsi_kuis'),
                'tanggal_mulai' => $request->input('tanggal_mulai'),
                'tanggal_selesai' => $request->input('tanggal_selesai'),
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

    // undang siswa
    public function store3(Request $request)
    {
        // Validasi data input
        $request->validate([
            'idenroll' => 'required|numeric',
            'tanggal_enroll' => 'required',
            'idsiswa' => 'required|numeric',
            'idkelas' => 'required|numeric',
        ]);
        $idkelas = $request->input('idkelas');

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
                'idenroll' => $request->input('idenroll'),
                'tanggal_enroll' => $request->input('tanggal_enroll'),
                'idsiswa' => $request->input('idsiswa'),
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
    
        return view('guru.progres', compact('siswa', 'tugasDikumpulkan', 'tugasBelumDikumpulkan','kelas'));
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

        // Buat PDF
        $pdf = FacadePdf::loadView('guru.rekapProgres', compact('siswa', 'tugasDikumpulkan', 'tugasBelumDikumpulkan'));
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
                ->route('tugaskuis.index')
                ->with('success', 'kuis berhasil diperbarui.');

        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('tugaskuis.index')
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
    public function destroy2($idkuis)
    {
        DB::beginTransaction();

        try {
            Kuis::where('idkuis', $idkuis)->delete();
    
            DB::commit();
    
            return redirect()
                ->route('tugaskuis.index')
                ->with('success', 'Kuis berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()
                ->route('tugaskuis.index')
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
