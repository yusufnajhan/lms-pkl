<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Enrollment;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function viewDashboardAdmin() {
        $userID = auth()->user()->id;
        $admin = Admin::where('iduser', $userID)->first();
        $nama = $admin->nama;
        $nik = $admin->nik;
        $username = $admin->user->username;

        // jumlah akun siswa dan guru
        $jumlahSiswa = Siswa::count();
        $jumlahGuru = Guru::count();
        
        return view("admin.beranda", compact('nama', 'nik', 'username', 'jumlahSiswa', 'jumlahGuru'));
    }

    public function viewDashboardGuru() {
        $userID = auth()->user()->id;
        $guru = Guru::where('iduser', $userID)->first();
        $nama = $guru->nama;
        $nik = $guru->nik;
        $username = $guru->user->username;

        // Menghitung jumlah kelas yang telah dibuat oleh guru ini
        $jumlahKelas = Kelas::where('idguru', $guru->idguru)->count();

        // Mengambil semua kelas yang dibuat oleh guru ini
        $kelasGuru = Kelas::where('idguru', $guru->idguru)->pluck('idkelas');

        // Menghitung jumlah siswa yang telah mendaftar di kelas yang dibuat oleh guru ini
        $jumlahSiswa = Enrollment::whereIn('idkelas', $kelasGuru)->distinct('idsiswa')->count('idsiswa');

        return view("guru.beranda", compact('nama', 'nik', 'username','jumlahKelas','jumlahSiswa'));
    }

    public function viewDashboardSiswa() {
        $userID = auth()->user()->id;
        $siswa = Siswa::where('iduser', $userID)->first();
        $nama = $siswa->nama;
        $nik = $siswa->nik;
        $username = $siswa->user->username;

        return view("siswa.beranda", compact('nama', 'nik', 'username'));
    }
    
}
