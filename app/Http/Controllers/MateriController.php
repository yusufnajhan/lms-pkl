<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index(int $idkelas)
    {
        $kelas = Kelas::findOrFail($idkelas);
        $materis = Materi::where('idkelas', $idkelas)->get();
        return view('guru.viewMateri', compact('kelas','materis'));
    }

    public function index2(int $idkelas)
    {
        $kelas = Kelas::findOrFail($idkelas);
        $materis = Materi::where('idkelas', $idkelas)->get();
        return view('siswa.viewMateri', compact('kelas','materis'));
    }


    public function create(int $idkelas)
    {
        $kelas = Kelas::findOrFail($idkelas);
        return view('guru.tambahMateri', compact('kelas'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'idmateri' => 'required|numeric',
            'judul_materi' => 'required',
            'deskripsi_materi' => 'required',
            'file_materi' => 'required|file|max:25600',
            'tanggal_upload' => 'required|date',
            'idkelas' => 'required|numeric',
        ]);
        $idkelas = $request->input('idkelas');

        if ($request->file('file_materi')) {
            $file_materi = $request->file('file_materi')->store('file_materi', 'public');
        }

        DB::beginTransaction();
        try 
        {
            // Simpan data tugas ke dalam database
            Materi::create([
                'idmateri' => $request->input('idmateri'),
                'judul_materi' => $request->input('judul_materi'),
                'deskripsi_materi' => $request->input('deskripsi_materi'),
                'file_materi' => $file_materi,
                'tanggal_upload' => $request->input('tanggal_upload'),
                'idkelas' => $request->input('idkelas'),
            ]);

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('materi.index', $idkelas)->with('success', 'Materi baru berhasil diupload.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('materi.index', $idkelas)
                ->with(['error' => 'Gagal upload materi baru. Error: ' . $e->getMessage()]);
        }
    }

    public function read(int $idmateri)
    {
        $materi = Materi::where('idmateri', $idmateri)->first();
        $kelas = Kelas::where('idkelas', $materi->idkelas)->first();

        return view('guru.readMateri', compact('materi', 'kelas'));
    }

    public function read2(int $idmateri)
    {
        $materi = Materi::where('idmateri', $idmateri)->first();
        $kelas = Kelas::where('idkelas', $materi->idkelas)->first();

        return view('siswa.readMateri', compact('materi', 'kelas'));
    }

    public function edit(int $idmateri)
    {
        $materi = Materi::where('idmateri', $idmateri)->first();
        $kelas = Kelas::where('idkelas', $materi->idkelas)->first();

        return view('guru.editMateri', compact('materi', 'kelas'));
    }

    public function update(Request $request, int $idmateri)
    {
        $request->validate([
            'judul_materi' => 'required',
            'deskripsi_materi' => 'required',
            'tanggal_upload' => 'required|date',
            'file_materi' => 'file|max:25600',
        ]);
        $idkelas = $request->input('idkelas');

        if ($request->file('file_materi')) {
            Storage::disk('public')->delete($request->input('oldFile'));
            $file_materi = $request->file('file_materi')->store('file_materi', 'public');
        }

        DB::beginTransaction();
        try {
            Materi::where('idmateri', $idmateri)->update([
                'judul_materi' => $request->input('judul_materi'),
                'deskripsi_materi' => $request->input('deskripsi_materi'),
                'tanggal_upload' => $request->input('tanggal_upload'),
            ]);
            if (isset($file_materi)) {
                Materi::where('idmateri', $idmateri)->update([
                    'file_materi' => $file_materi
                ]);
            }
            
            DB::commit();

            return redirect()
                ->route('materi.index', $idkelas)
                ->with('success', 'Materi berhasil diperbarui.');

        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('materi.index', $idkelas)
                ->with(['error' => 'Gagal memperbarui materi. Error: ' . $e->getMessage()]);
        }
    }

    public function destroy($idkelas, $idmateri)
    {
        DB::beginTransaction();

        try {
            $materi = Materi::where('idmateri', $idmateri);
            $file_materi = $materi->file_materi;
            $materi->delete();
    
            DB::commit();

            Storage::disk('public')->delete($file_materi);

            return redirect()
                ->route('materi.index', $idkelas)
                ->with('success', 'Materi berhasil dihapus.');
                
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()
                ->route('materi.index', $idkelas)
                ->with(['error' => 'Gagal menghapus materi. Error: ' . $e->getMessage()]);
        }
    }
}
