<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tugas;
use Illuminate\Http\Request;

class ProgresSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idkelas, $idsiswa)
    {
        // Ambil data kelas
        $kelas = Kelas::findOrFail($idkelas);

        // Ambil data siswa
        $siswa = Siswa::findOrFail($idsiswa);

        // Ambil semua data tugas dan pengumpulan tugas untuk kelas dan siswa tertentu
        $tugass = Tugas::where('idkelas', $idkelas)
            ->with(['pengumpulanTugas' => function ($query) use ($idsiswa) {
                $query->where('idsiswa', $idsiswa);
            }])
            ->get();

        return view('guru.progres', compact('kelas', 'siswa', 'tugass'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

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
