<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\Pengumpulan_Tugas;
use App\Models\Siswa;
use App\Models\Tugas;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasukKelasSiswaController extends Controller
{
    public function index($idkelas)
    {
        $idsiswa = auth()->user()->id;
        $kumpultugas = Pengumpulan_Tugas::where('idsiswa', $idsiswa)->get();
        $kelas = Kelas::findOrFail($idkelas);
        $tugass = Tugas::where('idkelas', $idkelas)->get();
        $kuiss = Kuis::where('idkelas', $idkelas)->get();
        $enrollments = Enrollment::with('siswa')->where('idkelas', $idkelas)->get();
        return view('siswa.masukKelas', compact('kelas','tugass','kuiss','enrollments','kumpultugas'));
    }

    public function read(int $idtugas)
    {
        $tugas = Tugas::where('idtugas', $idtugas)->first();
        $kelas = Kelas::where('idkelas', $tugas->idkelas)->first();

        return view('siswa.detailtugas', compact('tugas', 'kelas'));
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
            'idpengumpulan' => 'required|numeric',
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
                'idpengumpulan' => $request->input('idpengumpulan'),
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

    // rekap tugas dan kuis siswa
    public function downloadRekapTugas($idkelas)
    {
        // Dapatkan idsiswa dari sesi atau guard auth saat ini
        $idsiswa = auth()->user()->id;
    
        // Ambil data kelas
        $kelas = Kelas::findOrFail($idkelas);
    
        // Ambil semua data tugas dan pengumpulan tugas untuk kelas dan siswa tertentu
        $tugass = Tugas::where('idkelas', $idkelas)
            ->with(['pengumpulanTugas' => function ($query) use ($idsiswa) {
                $query->where('idsiswa', $idsiswa);
            }])
            ->get();
    
        // Ambil semua data kuis dan pengumpulan kuis untuk kelas dan siswa tertentu
        $kuiss = Kuis::where('idkelas', $idkelas)
            ->with(['pengumpulanKuis' => function ($query) use ($idsiswa) {
                $query->where('idsiswa', $idsiswa);
            }])
            ->get();
    
        // Buat PDF
        $pdf = FacadePdf::loadView('siswa.rekapTugas', compact('kelas', 'tugass', 'kuiss'));
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
