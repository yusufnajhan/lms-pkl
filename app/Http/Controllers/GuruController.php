<?php

namespace App\Http\Controllers;
use App\Models\Guru;


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
}
