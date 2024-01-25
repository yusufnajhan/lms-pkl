<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Support\Facades\DB;

class MateriController extends Controller
{
    public function index()
    {
        $materis = Materi::all();
        return view('guru.viewMateri', compact('materis'));
    }

    public function create()
    {
        $kelass = Kelas::pluck('idkelas', 'idkelas');
        return view('guru.tambahMateri', compact('kelass'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'idmateri' => 'required|numeric',
            'judul_materi' => 'required',
            'file_materi' => 'required',
            'tanggal_upload' => 'required|date',
            'idkelas' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try 
        {
            // Simpan data tugas ke dalam database
            Materi::create([
                'idmateri' => $request->input('idmateri'),
                'judul_materi' => $request->input('judul_materi'),
                'file_materi' => $request->input('file_materi'),
                'tanggal_upload' => $request->input('tanggal_upload'),
                'idkelas' => $request->input('idkelas'),
            ]);

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('materi.index')->with('success', 'Materi baru berhasil diupload.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('materi.index')
                ->with(['error' => 'Gagal upload materi baru. Error: ' . $e->getMessage()]);
        }
    }
}
