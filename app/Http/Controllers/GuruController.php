<?php

namespace App\Http\Controllers;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class GuruController extends Controller
{
    // profil
    public function edit(){
        $userID = auth()->user()->id;

        $guru = Guru::where('iduser', $userID)->first();

        $nama = $guru->nama;
        $nik = $guru->nik;
        $jenis_kelamin = $guru->jenis_kelamin;
        $tanggal_lahir = $guru->tanggal_lahir;
        $email = $guru->email;
        $nomor_hp = $guru->nomor_hp;

        $username = $guru->user->username;
        $password = $guru->user->password;

        return view("guru.profil", compact('nama', 'nik', 'jenis_kelamin', 'tanggal_lahir',
                                                'email', 'nomor_hp', 'username', 'password'));
    }

    // // edit profil
    // public function edit(Request $request, $idguru)
    // {
    //     $guru = Guru::where('idguru', $idguru)->first();

    //     $nama = $guru->nama;
    //     $nik = $guru->nik;
    //     $jenis_kelamin = $guru->jenis_kelamin;
    //     $tanggal_lahir = $guru->tanggal_lahir;
    //     $email = $guru->email;
    //     $nomor_hp = $guru->nomor_hp;

    //     $username = $guru->user->username;
    //     $password = $guru->user->password;

    //     return view("admin.editprofil", compact('idguru','nama', 'nik', 'jenis_kelamin', 'tanggal_lahir',
    //                                             'email', 'nomor_hp', 'username', 'password'));
    // }
    // public function update(Request $request)
    // {
    //     $userID = auth()->user()->id;
    //     $validated = $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'nik' => 'required|numeric',
    //         'jenis_kelamin' => 'required|in:Pria,Wanita',
    //         'tanggal_lahir' => 'required|date',
    //         'email' => 'required|email|max:255',
    //         'nomor_hp' => 'required|numeric',
    //     ]);

    //     DB::beginTransaction();
    //     try {
    //         Siswa::where('iduser', $userID)->update($validated);
    //         DB::commit();

    //         return redirect()
    //             ->route('guru.editprofil')
    //             ->with('success', 'Akun siswa berhasil diperbarui.');

    //     }

    //     catch (\Exception $e) 
    //     {
    //         DB::rollBack();
    //         return redirect()
    //             ->route('siswa.editprofil')
    //             ->withErrors(['error' => 'Gagal memperbarui akun siswa. Error: ' . $e->getMessage()]);
    //     }

    //     // $siswa = Siswa::find($idguru);
    //     // return view('siswa.edit', compact('siswa'));
    // }
}
