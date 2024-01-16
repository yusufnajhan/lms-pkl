<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function viewDashboardAdmin() {
        $userID = auth()->user()->id;
        $admin = Admin::where('iduser', $userID)->first();
        $nama = $admin->nama;
        
        return view("admin.beranda", compact('nama'));
    }

    public function viewDashboardGuru() {
        $userID = auth()->user()->id;
        $guru = Guru::where('iduser', $userID)->first();
        $nama = $guru->nama;

        return view("guru.beranda", compact('nama'));
    }

    public function viewDashboardSiswa() {
        $userID = auth()->user()->id;
        $siswa = Siswa::where('iduser', $userID)->first();
        $nama = $siswa->nama;

        return view("siswa.beranda", compact('nama'));
    }
    
}