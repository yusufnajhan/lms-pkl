<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class MasukKelasController extends Controller
{
    // read
    public function index()
    {
    $kelas = Kelas::first();
    return view('guru.masukKelas', compact('kelas'));
    }
}
