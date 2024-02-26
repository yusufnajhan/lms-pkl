<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class KelasSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $kelass = Auth::user()->dataPribadi->kelas;

        foreach ($kelass as $kelas) {
            $kelas->isExpired = Carbon::now()->greaterThan($kelas->tanggal_tutup); // Check if the class is expired
        }

        if ($status) {
            $kelass = $kelass->filter(function ($kelas) use ($status) {
                if ($status == 'aktif') {
                    return !$kelas->isExpired;
                } else if ($status == 'tidak aktif') {
                    return $kelas->isExpired;
                } else if ($status == 'semua') {
                    return true; // Return all classes
                }
            })->values();
        }

        return view('siswa.kelas', compact('kelass'));
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
