<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class AkunSiswaController extends Controller
{
    // read
    public function index()
    {
    $siswas = Siswa::all();
    return view('admin.siswa', compact('siswas'));
    }

    // add
    public function store(Request $request)
    {
    // Validasi data input
    $request->validate([
        'idsiswa' => 'required|numeric',
        'nama' => 'required|string|max:255',
        'nik' => 'required|numeric',
        'jenkel' => 'required|in:pria,wanita',
        'tgllahir' => 'required|date',
        'email' => 'required|email|max:255',
        'nohp' => 'required|numeric',
        'iduser' => 'required|numeric'
    ]);

    // Simpan data siswa ke dalam database
    Siswa::create([
        'idsiswa' => $request->input('idsiswa'),
        'nama' => $request->input('nama'),
        'nik' => $request->input('nik'),
        'jenis_kelamin' => $request->input('jenkel'),
        'tanggal_lahir' => $request->input('tgllahir'),
        'email' => $request->input('email'),
        'nomor_hp' => $request->input('nohp'),
        'iduser' => $request->input('iduser')
    ]);

    // Redirect atau kembalikan respons sesuai kebutuhan
    return redirect()->route('siswa.index')->with('success', 'Akun siswa berhasil ditambahkan.');
    }
}
