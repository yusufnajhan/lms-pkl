<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DasborSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $siswa = Auth::user()->dataPribadi;

        if (!$siswa) {
            // Handle the case where the user is not a siswa
            return redirect()->back()->with('error', 'You are not a siswa.');
        }

        // Assuming you have a relationship in your Siswa model called 'kelas'
        $enrolledKelas = $siswa->kelas;

        $currentDate = Carbon::now(); // get current date

        // filter the enrolledKelas based on tanggal_tutup
        $activeKelas = $enrolledKelas->where('tanggal_tutup', '>', $currentDate);

        $tugass = Tugas::whereIn('idkelas', $activeKelas->pluck('idkelas'))->get();
        $kuiss = Kuis::whereIn('idkelas', $activeKelas->pluck('idkelas'))->get();

        return view('siswa.dasbor', compact('tugass', 'kuiss'));
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
