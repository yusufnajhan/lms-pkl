<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\Tugas;
use Illuminate\Http\Request;

class MasukKelasSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idkelas)
    {
        $kelas = Kelas::findOrFail($idkelas);
        $tugass = Tugas::where('idkelas', $idkelas)->get();
        $kuiss = Kuis::where('idkelas', $idkelas)->get();
        $enrollments = Enrollment::with('siswa')->where('idkelas', $idkelas)->get();
        return view('siswa.masukKelas', compact('kelas','tugass','kuiss','enrollments'));
    }

    public function read(int $idtugas)
    {
        $tugas = Tugas::where('idtugas', $idtugas)->first();
        $kelas = Kelas::where('idkelas', $tugas->idkelas)->first();

        return view('siswa.detailtugas', compact('tugas', 'kelas'));
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
