<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    // profil
    public function edit(){
        $userID = auth()->user()->id;

        $admin = Admin::where('iduser', $userID)->first();

        $nama = $admin->nama;
        $nik = $admin->nik;
        $jenis_kelamin = $admin->jenis_kelamin;
        $tanggal_lahir = $admin->tanggal_lahir;
        $email = $admin->email;
        $nomor_hp = $admin->nomor_hp;

        $username = $admin->user->username;
        $password = $admin->user->password;

        return view("admin.profil", compact('nama', 'nik', 'jenis_kelamin', 'tanggal_lahir',
                                                'email', 'nomor_hp', 'username', 'password'));
    }

    public function beranda()
    {
        // Mengambil satu data admin pertama dengan relasi ke users
        $admin = Admin::with('user')->first();

        // Mengambil jumlah akun Guru
        $jumlahAkunGuru = Guru::count();

        // Mengambil jumlah akun Siswa
        $jumlahAkunSiswa = Siswa::count();

        // Menampilkan view beranda dengan data admin
        return view('admin.beranda', ['admin' => $admin, 'jumlahAkunGuru' => $jumlahAkunGuru, 'jumlahAkunSiswa' => $jumlahAkunSiswa]);
        
    }
}
