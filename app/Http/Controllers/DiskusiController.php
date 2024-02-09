<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Diskusi;
use Illuminate\Support\Facades\DB;


class DiskusiController extends Controller
{
    public function index(int $idkelas)
    {
        $kelas = Kelas::findOrFail($idkelas);
        $diskusis = Diskusi::where('idkelas', $idkelas)->get();
        return view('guru.viewDiskusi', compact('kelas','diskusis'));
    }

    public function create(int $idkelas)
    {
        $kelas = Kelas::findOrFail($idkelas);
        return view('guru.tambahDiskusi', compact('kelas'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'iddiskusi' => 'required|numeric',
            'judul_diskusi' => 'required',
            'deskripsi_diskusi' => 'required',
            'tanggal_upload' => 'required|date',
            'idkelas' => 'required|numeric',
        ]);
        $idkelas = $request->input('idkelas');

        DB::beginTransaction();
        try 
        {
            // Simpan data tugas ke dalam database
            Diskusi::create([
                'iddiskusi' => $request->input('iddiskusi'),
                'judul_diskusi' => $request->input('judul_diskusi'),
                'deskripsi_diskusi' => $request->input('deskripsi_diskusi'),
                'tanggal_upload' => $request->input('tanggal_upload'),
                'idkelas' => $request->input('idkelas'),
            ]);

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('diskusi.index', $idkelas)->with('success', 'Diskusi baru berhasil diupload.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('diskusi.index', $idkelas)
                ->with(['error' => 'Gagal menambah diskusi baru. Error: ' . $e->getMessage()]);
        }
    }

    public function read(int $iddiskusi)
    {
        $diskusi = Diskusi::where('iddiskusi', $iddiskusi)->first();
        $kelas = Kelas::where('idkelas', $diskusi->idkelas)->first();

        return view('guru.readDiskusi', compact('diskusi', 'kelas'));
    }

    public function edit(int $iddiskusi)
    {
        $diskusi = Diskusi::where('iddiskusi', $iddiskusi)->first();
        $kelas = Kelas::where('idkelas', $diskusi->idkelas)->first();

        return view('guru.editDiskusi', compact('diskusi', 'kelas'));
    }

    public function update(Request $request, int $iddiskusi)
    {
        $request->validate([
            'judul_diskusi' => 'required',
            'tanggal_upload' => 'required|date',
            'deskripsi_diskusi' => 'required',
        ]);
        $idkelas = $request->input('idkelas');

        DB::beginTransaction();
        try {
            Diskusi::where('iddiskusi', $iddiskusi)->update([
                'judul_diskusi' => $request->input('judul_diskusi'),
                'tanggal_upload' => $request->input('tanggal_upload'),
                'deskripsi_diskusi' => $request->input('deskripsi_diskusi'),
            ]);
            
            DB::commit();

            return redirect()
                ->route('diskusi.index', $idkelas)
                ->with('success', 'Diskusi berhasil diperbarui.');

        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('diskusi.index', $idkelas)
                ->with(['error' => 'Gagal memperbarui diskusi. Error: ' . $e->getMessage()]);
        }
    }

    public function destroy($idkelas, $iddiskusi)
    {
        DB::beginTransaction();

        try {
            Diskusi::where('iddiskusi', $iddiskusi)->delete();
    
            DB::commit();
    
            return redirect()
                ->route('diskusi.index', $idkelas)
                ->with('success', 'Diskusi berhasil dihapus.');
                
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()
                ->route('diskusi.index', $idkelas)
                ->with(['error' => 'Gagal menghapus diskusi. Error: ' . $e->getMessage()]);
        }
    }



}
