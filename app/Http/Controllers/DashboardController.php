<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function viewDashboardGuru() {
        return view('guru/beranda');
    }

    public function viewDashboardSiswa() {
        return view('siswa/beranda');
    }
    
}
