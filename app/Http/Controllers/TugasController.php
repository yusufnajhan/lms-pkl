<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Kuis;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TugasController extends Controller
{
    // read
    public function index()
    {
    $tugass = Tugas::all();
    $kuiss = Kuis::all();
    return view('guru.masukKelas', compact('tugass','kuiss'));
    }
    
    public function create()
    {
        $kelass = Kelas::pluck('idkelas', 'idkelas');
        return view('guru.tambahTugas', compact('kelass'));
    }

    public function create2()
    {
        $kelass = Kelas::pluck('idkelas', 'idkelas');
        return view('guru.tambahKuis', compact('kelass'));
    }

    // add tugas
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'idtugas' => 'required|numeric',
            'judul_tugas' => 'required',
            'deskripsi_tugas' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'idkelas' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try 
        {
            // Simpan data tugas ke dalam database
            Tugas::create([
                'idtugas' => $request->input('idtugas'),
                'judul_tugas' => $request->input('judul_tugas'),
                'deskripsi_tugas' => $request->input('deskripsi_tugas'),
                'tanggal_mulai' => $request->input('tanggal_mulai'),
                'tanggal_selesai' => $request->input('tanggal_selesai'),
                'idkelas' => $request->input('idkelas'),
            ]);

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('tugaskuis.index')->with('success', 'Tugas baru berhasil ditambahkan.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('tugaskuis.index')
                ->with(['error' => 'Gagal menambah tugas baru. Error: ' . $e->getMessage()]);
        }
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
            return redirect()->route('tugaskuis.index')->with('success', 'kuis baru berhasil ditambahkan.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('tugaskuis.index')
                ->with(['error' => 'Gagal menambah kuis baru. Error: ' . $e->getMessage()]);
        }
    }

    // edit tugas
    public function edit(Request $request, $idtugas)
    {
        $tugas = Tugas::where('idtugas', $idtugas)->first();

        $judul_tugas = $tugas->judul_tugas;
        $deskripsi_tugas = $tugas->deskripsi_tugas;
        $tanggal_mulai = $tugas->tanggal_mulai;
        $tanggal_selesai = $tugas->tanggal_selesai;
        $idkelas = $tugas->idkelas;

        $kelass = Kelas::pluck('idkelas', 'idkelas');

        return view("guru.edittugas", compact('idtugas','judul_tugas', 'deskripsi_tugas', 'tanggal_mulai', 'tanggal_selesai'
                                            ,'idkelas','kelass'));
    }

    public function update(Request $request, $idtugas)
    {
        $validated = $request->validate([
            'judul_tugas' => 'required',
            'deskripsi_tugas' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'idkelas' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            Tugas::where('idtugas', $idtugas)->update($validated);
            DB::commit();

            return redirect()
                ->route('tugaskuis.index')
                ->with('success', 'Tugas berhasil diperbarui.');

        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('tugaskuis.index')
                ->withErrors(['error' => 'Gagal memperbarui tugas. Error: ' . $e->getMessage()]);
        }
    }

    // edit kuis
    public function edit2(Request $request, $idkuis)
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
    public function destroy($idtugas)
    {
        DB::beginTransaction();

        try {
            Tugas::where('idtugas', $idtugas)->delete();
    
            DB::commit();
    
            return redirect()
                ->route('tugaskuis.index')
                ->with('success', 'Tugas berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()
                ->route('tugaskuis.index')
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

}
