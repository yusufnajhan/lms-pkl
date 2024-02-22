<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Kuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KuisController extends Controller
{
    public function create(int $idkelas)
    {
        $kelas = Kelas::findOrFail($idkelas);
        return view('guru.tambahKuis', compact('kelas'));
    }

    // add
    public function store(Request $request)
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
            return redirect()->route('kuis.index')->with('success', 'kuis baru berhasil ditambahkan.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('kuis.index')
                ->with(['error' => 'Gagal menambah kuis baru. Error: ' . $e->getMessage()]);
        }
    }
    
    // edit
    public function edit(Request $request, $idkuis)
    {
        $kuis = Kuis::where('idkuis', $idkuis)->first();

        $judul_kuis = $kuis->judul_kuis;
        $deskripsi_kuis = $kuis->deskripsi_kuis;
        $tanggal_mulai = $kuis->tanggal_mulai;
        $tanggal_selesai = $kuis->tanggal_selesai;
        $idkelas = $kuis->idkelas;

        $kelass = Kelas::pluck('idkelas', 'idkelas');

        return view("guru.editkuis", compact('idkuis','judul_kuis', 'deskripsi_kuis', 'tanggal_mulai', 'tanggal_selesai'
                                            ,'idkelas','kelass'));
    }

    public function update(Request $request, $idkuis)
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
                ->route('kuis.index')
                ->with('success', 'kuis berhasil diperbarui.');

        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('kuis.index')
                ->withErrors(['error' => 'Gagal memperbarui kuis. Error: ' . $e->getMessage()]);
        }
    }

    // delete
    public function destroy($idkuis)
    {
        DB::beginTransaction();

        try {
            kuis::where('idkuis', $idkuis)->delete();
    
            DB::commit();
    
            return redirect()
                ->route('kuis.index')
                ->with('success', 'Kuis berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()
                ->route('kuis.index')
                ->withErrors(['error' => 'Gagal menghapus kuis. Error: ' . $e->getMessage()]);
        }
    }
}
