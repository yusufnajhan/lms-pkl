<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    // read
    public function index()
    {
        // $kelass = Kelas::all();
        // return view('guru.kelas', compact('kelass'));

        $idguru = auth()->user()->dataPribadi->idguru; // Get the id of the currently logged-in user
        $kelass = Kelas::where('idguru', $idguru)->get(); // Filter Kelas based on idguru

        // Add the count of 'siswa' to each 'kelas'
        foreach ($kelass as $kelas) {
            $kelas->jumlahSiswa = $kelas->siswas->count();
        }

        return view('guru.kelas', compact('kelass'));
    }

    public function create()
    {
        return view('guru.tambahkelas');
    }

    // add
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'idkelas' => 'required|numeric',
            'mata_pelajaran' => 'required|in:Agama,Matematika,Bahasa Inggris,
            Bahasa Indonesia,PKN,IPAS,IPS,Informatika,Prakarya,PJOK',
            'indeks_kelas' => 'required|in:A,B,C,D,E',
            'jenjang_kelas' => 'required|in:7,8,9',
            'tanggal_dibuat' => 'required|date',
            'tanggal_tutup' => 'required|date',
            'idguru' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try 
        {
            // Simpan data kelas ke dalam database
            Kelas::create([
                'idkelas' => $request->input('idkelas'),
                'mata_pelajaran' => $request->input('mata_pelajaran'),
                'indeks_kelas' => $request->input('indeks_kelas'),
                'jenjang_kelas' => $request->input('jenjang_kelas'),
                'tanggal_dibuat' => $request->input('tanggal_dibuat'),
                'tanggal_tutup' => $request->input('tanggal_tutup'),
                'idguru' => $request->input('idguru'),
            ]);

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('kelas.index')->with('success', 'Kelas baru berhasil ditambahkan.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('kelas.index')
                ->with(['error' => 'Gagal menambah kelas baru. Error: ' . $e->getMessage()]);
        }
    
    
    }

    // edit
    public function edit(Request $request, $idkelas)
    {
        $kelas = Kelas::where('idkelas', $idkelas)->first();

        $mata_pelajaran = $kelas->mata_pelajaran;
        $indeks_kelas = $kelas->indeks_kelas;
        $jenjang_kelas = $kelas->jenjang_kelas;
        $tanggal_dibuat = $kelas->tanggal_dibuat;
        $tanggal_tutup = $kelas->tanggal_tutup;
        $idguru = $kelas->idguru;


        return view("guru.editkelas", compact('idkelas','mata_pelajaran', 'indeks_kelas', 'jenjang_kelas', 'tanggal_dibuat',
                                                'tanggal_tutup','idguru'));
    }

    public function update(Request $request, $idkelas)
    {
        $validated = $request->validate([
            'mata_pelajaran' => 'required|in:Agama,Matematika,Bahasa Inggris,
            Bahasa Indonesia,PKN,IPAS,IPS,Informatika,Prakarya,PJOK',
            'indeks_kelas' => 'required|in:A,B,C,D,E',
            'jenjang_kelas' => 'required|in:7,8,9',
            'tanggal_dibuat' => 'required|date',
            'tanggal_tutup' => 'required|date',
            'idguru' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            Kelas::where('idkelas', $idkelas)->update($validated);
            DB::commit();

            return redirect()
                ->route('kelas.index')
                ->with('success', 'Kelas berhasil diperbarui.');

        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('kelas.index')
                ->withErrors(['error' => 'Gagal memperbarui kelas. Error: ' . $e->getMessage()]);
        }
    }

    // delete
    public function destroy($idkelas)
    {
        DB::beginTransaction();

        try {
            // Delete the class and its associated records
            Kelas::where('idkelas', $idkelas)->delete();
    
            DB::commit();
    
            return redirect()
                ->route('kelas.index')
                ->with('success', 'Kelas berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()
                ->route('kelas.index')
                ->withErrors(['error' => 'Gagal menghapus kelas. Error: ' . $e->getMessage()]);
        }
    }
}
