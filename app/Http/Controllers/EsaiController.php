<?php

namespace App\Http\Controllers;

use App\Models\Esai;
use App\Models\Kuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EsaiController extends Controller
{
    // read
    public function index()
    {
        $esais = Esai::all();
        return view('guru.soalesai', compact('esais'));
    }

    public function create()
    {
        $kuiss = Kuis::pluck('idkuis', 'idkuis');
        return view('guru.tambahesai', compact('kuiss'));
    }

    // add
    public function store(Request $request)
    {
        $request->validate([
            'idkuis' => 'required',
            'soal' => 'required',
        ]);

        DB::beginTransaction();

        try 
        {
            // Simpan data esai ke dalam database
            Esai::create([
                'idkuis' => $request->input('idkuis'),
                'soal' => $request->input('soal'),
            ]);

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('esai.index')->with('success', 'Esai baru berhasil ditambahkan.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('esai.index')
                ->with(['error' => 'Gagal menambah esai baru. Error: ' . $e->getMessage()]);
        }

   }

   // edit
   public function edit(Request $request, $idesai)
   {
       $esai = Esai::where('idesai', $idesai)->first();

       $soal = $esai->soal;
       $idkuis = $esai->idkuis;
       
       $kuiss = Kuis::pluck('idkuis', 'idkuis');

       return view("guru.editesai", compact('idesai','soal','idkuis','kuiss'));
   }

   public function update(Request $request, $idesai)
   {
       $validated = $request->validate([
            'idkuis' => 'required',
            'soal' => 'required',
       ]);

       DB::beginTransaction();
       try {
           Esai::where('idesai', $idesai)->update($validated);
           DB::commit();

           return redirect()
               ->route('esai.index')
               ->with('success', 'Esai berhasil diperbarui.');

       }

       catch (\Exception $e) 
       {
           DB::rollBack();
           return redirect()
               ->route('esai.index')
               ->withErrors(['error' => 'Gagal memperbarui esai. Error: ' . $e->getMessage()]);
       }
   }

   // delete
   public function destroy($idesai)
   {
       DB::beginTransaction();

       try {
           Esai::where('idesai', $idesai)->delete();
   
           DB::commit();
   
           return redirect()
               ->route('esai.index')
               ->with('success', 'Esai berhasil dihapus.');
       } catch (\Exception $e) {
           DB::rollBack();
   
           return redirect()
               ->route('esai.index')
               ->withErrors(['error' => 'Gagal menghapus esai. Error: ' . $e->getMessage()]);
       }
   }
}
