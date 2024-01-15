<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use Illuminate\Support\Facades\DB;

class AkunGuruController extends Controller
{
    // read
    public function index()
    {
    $gurus = Guru::all();
    return view('admin.guru', compact('gurus'));
    }

    // add
    public function store(Request $request)
    {
    // Validasi data input
    $request->validate([
        'idguru' => 'required|numeric',
        'nama' => 'required|string|max:255',
        'nik' => 'required|numeric',
        'jenkel' => 'required|in:pria,wanita',
        'tgllahir' => 'required|date',
        'email' => 'required|email|max:255',
        'nohp' => 'required|numeric',
        'iduser' => 'required|numeric'
    ]);

    // Simpan data guru ke dalam database
    Guru::create([
        'idguru' => $request->input('idguru'),
        'nama' => $request->input('nama'),
        'nik' => $request->input('nik'),
        'jenis_kelamin' => $request->input('jenkel'),
        'tanggal_lahir' => $request->input('tgllahir'),
        'email' => $request->input('email'),
        'nomor_hp' => $request->input('nohp'),
        'iduser' => $request->input('iduser')
    ]);

    // Redirect atau kembalikan respons sesuai kebutuhan
    return redirect()->route('guru.index')->with('success', 'Akun guru berhasil ditambahkan.');
    }

    // edit
    public function edit(Request $request, $idguru)
    {
        $guru = Guru::where('idguru,', $idguru)->first();

        $nama = $guru->nama;
        $nik = $guru->nik;
        $jenis_kelamin = $guru->jenis_kelamin;
        $tanggal_lahir = $guru->tanggal_lahir;
        $email = $guru->email;
        $nomor_hp = $guru->nomor_hp;
        $iduser = $guru->iduser;

        return view("admin.editguru", compact('idguru','nama', 'nik', 'jenis_kelamin', 'tanggal_lahir',
                                                'email', 'nomor_hp', 'iduser'));
    }

    public function update(Request $request, $idguru)
    {
        $user = Guru::where('idguru', $idguru)->first();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric',
            'jenkel' => 'required|in:pria,wanita',
            'tgllahir' => 'required|date',
            'email' => 'required|email|max:255',
            'nohp' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            if (!empty($validated['nama'])) {
                Guru::where('idguru', $idguru)->update([
                    'nama' => $validated['nama'],
                ]);
            }

            if (!empty($validated['nik'])) {
                Guru::where('idguru', $idguru)->update([
                    'nik' => $validated['nik'],
                ]);
            }

            if (!empty($validated['jenkel'])) {
                Guru::where('idguru', $idguru)->update([
                    'jenkel' => $validated['jenkel'],
                ]);
            }

            if (!empty($validated['tgllahir'])) {
                Guru::where('idguru', $idguru)->update([
                    'tgllahir' => $validated['tgllahir'],
                ]);
            }

            if (!empty($validated['email'])) {
                Guru::where('idguru', $idguru)->update([
                    'email' => $validated['email'],
                ]);
            }

            if (!empty($validated['nohp'])) {
                Guru::where('idguru', $idguru)->update([
                    'nohp' => $validated['nohp'],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('guru.edit')
                ->with('success', 'Akun guru berhasil diperbarui.');

        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('guru.edit')
                ->with('error', 'Gagal memperbarui akun guru. Error: ' . $e->getMessage());
        }

        // $guru = Guru::find($idguru);
        // return view('guru.edit', compact('guru'));
    }

}
