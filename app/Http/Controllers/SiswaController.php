<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // profil
    public function edit(){
        $userID = auth()->user()->id;

        $siswa = Siswa::where('iduser', $userID)->first();

        $nama = $siswa->nama;
        $nik = $siswa->nik;
        $jenis_kelamin = $siswa->jenis_kelamin;
        $tanggal_lahir = $siswa->tanggal_lahir;
        $email = $siswa->email;
        $nomor_hp = $siswa->nomor_hp;

        $username = $siswa->user->username;
        $password = $siswa->user->password;

        return view("siswa.profil", compact('nama', 'nik', 'jenis_kelamin', 'tanggal_lahir',
                                                'email', 'nomor_hp', 'username', 'password'));
    }
}
