<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Guru;
use App\Models\Jawaban_Kuis;
use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\Pengumpulan_Kuis;
use App\Models\Pengumpulan_Tugas;
use App\Models\Siswa;
use App\Models\Tugas;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MasukKelasSiswaController extends Controller
{
    public function index(Request $request, $idkelas)
    {
        $status = $request->input('status');
        $idsiswa = auth()->user()->id;
        $kumpultugas = Pengumpulan_Tugas::where('idsiswa', $idsiswa)->get();
        $kumpulkuis = Jawaban_Kuis::where('idsiswa', $idsiswa)->get();
        // dd($kumpulkuis);
        $kelas = Kelas::findOrFail($idkelas);
        $tugass = Tugas::where('idkelas', $idkelas)->get();
        $kuiss = Kuis::where('idkelas', $idkelas)->get();
        $enrollments = Enrollment::with('siswa')->where('idkelas', $idkelas)->get();
        
        $pengumpulanTugas = Pengumpulan_Tugas::where('idsiswa', $idsiswa)
        ->whereNotNull('nilai') // Pastikan tugas sudah dinilai
        ->whereIn('idtugas', function ($query) use ($idkelas) {
            $query->select('idtugas')
                ->from('tugas')
                ->where('idkelas', $idkelas);
        })
        ->get();

        foreach ($tugass as $tugas) {
            $tugas->isExpired = Carbon::now()->greaterThan($tugas->tanggal_selesai); // Check if the tugas is expired
            $tugas->isSubmitted = $kumpultugas->contains('idtugas', $tugas->idtugas); // Check if the tugas is submitted
        }

        foreach ($kuiss as $kuis) {
            $kuis->isExpiredkuis = Carbon::now()->greaterThan($kuis->tanggal_selesai); // Check if the kuis is expired
            $kuis->isSubmitted = $kumpultugas->contains('idkuis', $kuis->idkuis); // Check if the kuis is submitted
        }

        if ($status) {
            $tugass = $tugass->filter(function ($tugas) use ($status) {
                if ($status == 'telah') {
                    return $tugas->isSubmitted;
                } else if ($status == 'belum') {
                    return !$tugas->isSubmitted;
                } else if ($status == 'semua') {
                    return true; // Return all tugas
                }
            })->values();
    
            $kuiss = $kuiss->filter(function ($kuis) use ($status) {
                if ($status == 'telah') {
                    return $kuis->isSubmitted;
                } else if ($status == 'belum') {
                    return !$kuis->isSubmitted;
                } else if ($status == 'semua') {
                    return true; // Return all kuis
                }
            })->values();
        }

        return view('siswa.masukKelas', compact('kelas','tugass','kuiss','enrollments','kumpultugas','kumpulkuis','pengumpulanTugas'));
    }


    public function read(int $idtugas)
    {
        $tugas = Tugas::where('idtugas', $idtugas)->first();
        $kelas = Kelas::where('idkelas', $tugas->idkelas)->first();

        return view('siswa.detailtugas', compact('tugas', 'kelas'));
    }

    public function read2(int $idkuis)
    {
        $kuis = Kuis::where('idkuis', $idkuis)->first();
        $kelas = Kelas::where('idkelas', $kuis->idkelas)->first();

        return view('siswa.detailkuis', compact('kuis', 'kelas'));
    }

    // siswa kumpul tugas
    public function create($idtugas)
    {

        $tugas = Tugas::findOrFail($idtugas);
        $siswas = Siswa::pluck('idsiswa', 'idsiswa');
        $kelas = Kelas::where('idkelas', $tugas->idkelas)->first();
        $guru = Guru::find($kelas->idguru);
        return view('siswa.kumpulTugas', compact('tugas', 'siswas', 'kelas', 'guru'));
    }


    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            // 'idpengumpulan' => 'required|numeric',
            'status' => 'required|in:1,0',
            'file_submit_tugas' => 'required|file|max:25600',
            'tanggal_pengumpulan' => 'required|date',
            'idsiswa' => 'required|numeric',
            'idguru' => 'required|numeric',
            'idtugas' => 'required|numeric',
            
        ]);
        $idtugas = $request->input('idtugas');
        $tugas = Tugas::find($idtugas);
        $idkelas = $tugas->idkelas;
        $kelas = Kelas::find($idkelas);
        $idguru = $kelas->idguru;

        if ($request->file('file_submit_tugas')) {
            $file_submit_tugas = $request->file('file_submit_tugas')->store('file_submit_tugas', 'public');
        }

        // Memeriksa apakah siswa sudah mengumpulkan tugas tersebut sebelumnya
        $existingSubmitTugas = Pengumpulan_Tugas::where('idsiswa', $request->input('idsiswa'))
            ->where('idtugas', $request->input('idtugas'))
            ->first();

        if ($existingSubmitTugas) {
            return redirect()
                ->route('siswamasuk.index', $idkelas)
                ->with(['error' => 'Siswa hanya dapat sekali mengumpulkan tugas.']);
        }

        DB::beginTransaction();
        try 
        {
            // Simpan data tugas ke dalam database
            Pengumpulan_Tugas::create([
                // 'idpengumpulan' => $request->input('idpengumpulan'),
                'status' => $request->input('status'),
                'file_submit_tugas' => $file_submit_tugas,
                'tanggal_pengumpulan' => $request->input('tanggal_pengumpulan'),
                'idsiswa' => $request->input('idsiswa'),
                'idguru' => $idguru,
                'idtugas' => $request->input('idtugas'),
            ]);

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('siswamasuk.index', $idkelas)->with('success', 'Berhasil mengumpulkan tugas.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('siswamasuk.index', $idkelas)
                ->with(['error' => 'Gagal mengumpulkan tugas. Error: ' . $e->getMessage()]);
        }
    }


    // public function edit($idtugas)
    // {
    //     $pengumpulanTugas = Pengumpulan_Tugas::find($idtugas);

    //     if (!$pengumpulanTugas) {
    //         // Handle the case where no pengumpulan tugas was found for the given id
    //         return redirect()->back()->with('error', 'Pengumpulan tugas tidak ditemukan.');
    //     }

    //     $kelas = Kelas::where('idkelas', $pengumpulanTugas->idkelas)->first();
    //     $tugas = Tugas::find($pengumpulanTugas->idtugas);
        
    //     return view('siswa.editKumpulTugas', compact('pengumpulanTugas', 'kelas', 'tugas'));
    // }

    public function edit($idtugas)
    {
        $tugas = Tugas::findOrFail($idtugas);
        // Cek apakah tanggal_selesai belum lewat
        if ($tugas->tanggal_selesai > now()) {
            $pengumpulan = Pengumpulan_Tugas::where('idtugas', $idtugas)->first();
            if ($pengumpulan) {
                $kelas = $tugas->kelas;
                return view('siswa.editKumpulTugas', compact('tugas', 'pengumpulan','kelas'));
            } else {
                return redirect()->route('siswamasuk.index')->with('error', 'Pengumpulan tugas tidak ditemukan.');
            }
        } else {
            return redirect()->route('siswamasuk.index')->with('error', 'Tugas sudah tutup, tidak dapat mengedit.');
        }
    }

    // public function update(Request $request, $idtugas)
    // {
    //     // Validasi data input
    //     $request->validate([
    //         // 'status' => 'required|in:1,0',
    //         'file_submit_tugas' => 'file|max:25600',
    //         'tanggal_pengumpulan' => 'required|date',
    //     ]);
    
    //     $pengumpulanTugas = Pengumpulan_Tugas::find($idtugas);
    
    //     if ($request->file('file_submit_tugas')) {
    //         // Hapus file lama
    //         Storage::delete('public/'.$pengumpulanTugas->file_submit_tugas);
    
    //         // Upload file baru
    //         $file_submit_tugas = $request->file('file_submit_tugas')->store('file_submit_tugas', 'public');
    //         $pengumpulanTugas->file_submit_tugas = $file_submit_tugas;
    //     }
    
    //     // $pengumpulanTugas->status = $request->input('status');
    //     $pengumpulanTugas->tanggal_pengumpulan = $request->input('tanggal_pengumpulan');
    //     $pengumpulanTugas->save();

    //     // Ambil objek Tugas
    //     $tugas = Tugas::find($pengumpulanTugas->idtugas);

    //     // Ambil idkelas dari objek Tugas
    //     $idkelas = $tugas->idkelas;

    //     // return redirect()->route('siswamasuk.index', $pengumpulanTugas->idkelas)->with('success', 'Berhasil mengupdate tugas.');
    //     return redirect()->route('siswamasuk.index', ['idkelas' => $idkelas])->with('success', 'Berhasil memperbarui tugas yang dikumpulkan.');

    // }

    public function update(Request $request, $idtugas)
    {
        $request->validate([
            'file_submit_tugas' => 'required|file|max:25600',
        ]);
    
        $pengumpulan = Pengumpulan_Tugas::where('idtugas', $idtugas)->first();
        if ($pengumpulan) {
            if ($request->file('file_submit_tugas')) {
                $file_submit_tugas = $request->file('file_submit_tugas')->store('file_submit_tugas', 'public');
                $pengumpulan->file_submit_tugas = $file_submit_tugas;
                $pengumpulan->save();
                $idkelas = $pengumpulan->tugas->idkelas;
                return redirect()->route('siswamasuk.index', $idkelas)->with('success', 'Pengumpulan tugas berhasil diubah.');
            }
        } else {
            return redirect()->route('siswamasuk.index')->with('error', 'Pengumpulan tugas tidak ditemukan.');
        }
    }


    // rekap tugas dan kuis siswa
    public function downloadRekapTugas($idkelas)
    {
        // Dapatkan idsiswa dari sesi atau guard auth saat ini
        $idsiswa = auth()->user()->id;

        $siswa = Siswa::where('iduser', $idsiswa)->first();
    
        // Ambil data kelas
        $kelas = Kelas::findOrFail($idkelas);
    
        // Ambil semua data tugas dan pengumpulan tugas untuk kelas dan siswa tertentu
        $tugass = Tugas::where('idkelas', $idkelas)
            ->with(['pengumpulanTugas' => function ($query) use ($idsiswa) {
                $query->where('idsiswa', $idsiswa);
            }])
            ->get();
      
        // Ambil nilai tugas yang sudah dinilai untuk siswa pada kelas tertentu
        $pengumpulanTugas = Pengumpulan_Tugas::where('idsiswa', $siswa->idsiswa)
        ->whereNotNull('nilai') // Pastikan tugas sudah dinilai
        ->whereIn('idtugas', function ($query) use ($idkelas) {
            $query->select('idtugas')
                ->from('tugas')
                ->where('idkelas', $idkelas);
        })
        ->get();


        // Hitung rata-rata nilai tugas
        $totalNilai = $pengumpulanTugas->sum('nilai');
        $jumlahTugas = $pengumpulanTugas->count();
        $rataTugas = $jumlahTugas > 0 ? $totalNilai / $jumlahTugas : 0;

        // Hitung rata-rata nilai tugas
        // $totalNilai = 0;
        // $jumlahTugas = 0;
        // foreach ($tugass as $tugas) {
        //     foreach ($tugas->pengumpulanTugas as $pengumpulanTugas) {
        //         if ($pengumpulanTugas->nilai) {
        //             $totalNilai += $pengumpulanTugas->nilai;
        //             $jumlahTugas++;
        //         }
        //     }
        // }

        // $rataTugas = $jumlahTugas > 0 ? $totalNilai / $jumlahTugas : 0;
    
        // Ambil semua data kuis dan pengumpulan kuis untuk kelas dan siswa tertentu
        $kuiss = Kuis::where('idkelas', $idkelas)
            ->with(['pengumpulanKuis' => function ($query) use ($idsiswa) {
                $query->where('idsiswa', $idsiswa);
            }])
            ->get();

        // Ambil nilai kuis yang sudah dinilai untuk siswa pada kelas tertentu
        $pengumpulanKuis = Jawaban_Kuis::select('idkuis', 'idsiswa', DB::raw('MAX(nilai) as nilai'))
            ->where('idsiswa', $siswa->idsiswa)
            ->whereNotNull('nilai') // Pastikan kuis sudah dinilai
            ->whereIn('idkuis', function ($query) use ($idkelas) {
                $query->select('idkuis')
                    ->from('kuis')
                    ->where('idkelas', $idkelas);
            })
            ->groupBy('idkuis', 'idsiswa') // Group berdasarkan idkuis dan idsiswa
            ->get();

        // Hitung rata-rata nilai kuis
        $totalNilaiKuis = $pengumpulanKuis->sum('nilai');
        $jumlahKuis = $pengumpulanKuis->count();
        $rataKuis = $jumlahKuis > 0 ? $totalNilaiKuis / $jumlahKuis : 0;

        // Buat PDF
        $pdf = FacadePdf::loadView('siswa.rekapTugas', compact('kelas', 'tugass', 'kuiss','rataTugas','rataKuis','pengumpulanKuis','pengumpulanTugas'));
        return $pdf->download('rekap_tugas_kuis.pdf');
    }    


    // public function store(Request $request)
    // {
    //     $siswa = Siswa::find($request->idsiswa);
    //     $tugas = Tugas::find($request->idtugas);

    //     // Check if the siswa has already made a submission for this tugas
    //     $existingSubmission = Pengumpulan_Tugas::where('idtugas', $tugas->idtugas)
    //         ->where('idsiswa', $siswa->idsiswa)
    //         ->first();

    //     if ($existingSubmission) {
    //         return response()->json([
    //             'message' => 'You have already made a submission for this task.'
    //         ], 400);
    //     }

    //     // If no existing submission, create a new one
    //     $pengumpulan = new Pengumpulan_Tugas;
    //     $pengumpulan->idtugas = $tugas->idtugas;
    //     $pengumpulan->idsiswa = $siswa->idsiswa;
    //     // add other fields as necessary
    //     $pengumpulan->save();

    //     return response()->json([
    //         'message' => 'Submission successful.'
    //     ], 200);
    // }

    // siswa kumpul kuis
    public function create2($idkuis)
    {

        $kuis = Kuis::findOrFail($idkuis);
        $siswas = Siswa::pluck('idsiswa', 'idsiswa');
        $kelas = Kelas::where('idkelas', $kuis->idkelas)->first();
        $guru = Guru::find($kelas->idguru);
        return view('siswa.kumpulKuis', compact('kuis', 'siswas', 'kelas', 'guru'));
    }

    public function store2(Request $request)
    {
        // Validasi data input
        $request->validate([
            'status' => 'required|in:1,0',
            'jawaban.*' => 'required', // Menerima array jawaban
            'tanggal_pengumpulan' => 'required|date',
            'idsiswa' => 'required|numeric',
            'idguru' => 'required|numeric',
            'idkuis' => 'required|numeric',
        ]);

        $idkuis = $request->input('idkuis');
        $kuis = Kuis::find($idkuis);
        $idkelas = $kuis->idkelas;
        $kelas = Kelas::find($idkelas);
        $idguru = $kelas->idguru;

        // Memeriksa apakah siswa sudah mengumpulkan tugas tersebut sebelumnya
        $existingSubmitKuis = Jawaban_Kuis::where('idsiswa', $request->input('idsiswa'))
            ->where('idkuis', $request->input('idkuis'))
            ->first();

        if ($existingSubmitKuis) {
            return redirect()
                ->route('siswamasuk.index', $idkelas)
                ->with(['error' => 'Siswa hanya dapat sekali mengumpulkan kuis.']);
        }

        DB::beginTransaction();
        try 
        {
            // Simpan setiap jawaban ke dalam tabel jawaban_kuis
            foreach ($request->input('jawaban') as $idsoal => $jawaban) {
                Jawaban_Kuis::create([
                    'idsoal' => $idsoal,
                    'status' => $request->input('status'),
                    'tanggal_pengumpulan' => $request->input('tanggal_pengumpulan'),
                    'jawaban' => $jawaban,
                    'idsiswa' => $request->input('idsiswa'),
                    'idguru' => $idguru,
                    'idkuis' => $idkuis,
                ]);
            }

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('siswamasuk.index', $idkelas)->with('success', 'Berhasil mengumpulkan kuis.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('siswamasuk.index', $idkelas)
                ->with(['error' => 'Gagal mengumpulkan kuis. Error: ' . $e->getMessage()]);
        }
    }

    // siswa edit jawaban kuis
    public function edit2($idkuis)
    {
        $kuis = Kuis::findOrFail($idkuis);
        // Cek apakah tanggal_selesai belum lewat
        if ($kuis->tanggal_selesai > now()) {
            $jawaban_kuis = Jawaban_Kuis::where('idkuis', $idkuis)->get();
            if ($jawaban_kuis) {
                $kelas = $kuis->kelas;
                return view('siswa.editKumpulKuis', compact('kuis', 'jawaban_kuis','kelas'));
            } else {
                return redirect()->route('siswamasuk.index')->with('error', 'Pengumpulan kuis tidak ditemukan.');
            }
        } else {
            return redirect()->route('siswamasuk.index')->with('error', 'Kuis sudah tutup, tidak dapat mengedit.');
        }
    }

    public function update2(Request $request, $idkuis)
    {
        $kuis = Kuis::find($idkuis);
        $request->validate([
            'jawaban.*' => 'required', // Menerima array jawaban
        ]);

        $jawaban_kuis = Jawaban_Kuis::where('idkuis', $idkuis)->get();

        if ($jawaban_kuis) {
            foreach ($request->input('jawaban') as $idsoal => $jawaban) {
                $jawaban_kuis_item = $jawaban_kuis->where('idsoal', $idsoal)->first();
                if ($jawaban_kuis_item) {
                    $jawaban_kuis_item->jawaban = $jawaban;
                    $jawaban_kuis_item->save();
                }
            }

            $idkelas = $kuis->idkelas;
            return redirect()->route('siswamasuk.index', $idkelas)->with('success', 'Jawaban kuis berhasil diubah.');
        } else {
            return redirect()->route('siswamasuk.index')->with('error', 'Jawaban kuis tidak ditemukan.');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
