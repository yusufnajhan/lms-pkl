<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body'=>'required',
        ]);

        DB::beginTransaction();
        try 
        {
            $idcomment = Comment::max('idcomment');
            if ($idcomment === null) {
                $idcomment = 8112;
            } else {
                $idcomment = $idcomment + 1;
            }
            // Simpan data ke dalam database
            Comment::create([
                'idcomment' => $idcomment,
                'iduser' => $request->input('iduser'),
                'iddiskusi' => $request->input('iddiskusi'),
                'body' => $request->input('body'),
            ]);

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return back()->with('success', 'Comment baru berhasil ditambahkan.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return back()
                ->with(['error' => 'Gagal menambah comment baru. Error: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $idcomment)
    {
        $request->validate([
            'body'=>'required',
        ]);

        DB::beginTransaction();

        try {
            Comment::where('idcomment', $idcomment)->update([
                'body' => $request->input('body'),                
            ]);
    
            DB::commit();
    
            return back()->with('success', 'Comment berhasil diubah.');
                
        } catch (\Exception $e) {
            DB::rollBack();
    
            return back()
                ->with(['error' => 'Gagal mengubah comment. Error: ' . $e->getMessage()]);
        }
    }

    public function destroy($idcomment) 
    {
        DB::beginTransaction();

        try {
            Comment::where('idcomment', $idcomment)->delete();
    
            DB::commit();
    
            return back()->with('success', 'Comment berhasil dihapus.');
                
        } catch (\Exception $e) {
            DB::rollBack();
    
            return back()
                ->with(['error' => 'Gagal menghapus comment. Error: ' . $e->getMessage()]);
        }
    }
}
