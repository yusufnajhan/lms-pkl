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
            $id = Comment::max('id');
            if ($id === null) {
                $id = 8112;
            } else {
                $id = $id + 1;
            }
            // Simpan data ke dalam database
            Comment::create([
                'id' => $id,
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
}
