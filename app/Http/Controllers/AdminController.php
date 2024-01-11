<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
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

    public function profil()
    {
        // Mengambil satu data admin pertama dengan relasi ke users
        $admin = Admin::with('user')->first();

        // Menampilkan view beranda dengan data admin
        return view('admin.profil', ['admin' => $admin]);
    }

    public function editprofil()
    {
        // Mengambil satu data admin pertama dengan relasi ke users
        $admin = Admin::with('user')->first();

        // Menampilkan view beranda dengan data admin
        return view('admin.editprofil', compact('admin'));
    }

    public function updateprofil(Request $request)
    {
        $admin = Admin::with('user')->first();

        // Validasi input jika diperlukan

        // Update email dan nomor HP
        $admin->email = $request->input('email');
        $admin->nomor_hp = $request->input('nohp');

        // Update password jika ada perubahan
        if ($request->filled('new_password')) {
            $admin->user->password = Hash::make($request->input('new_password'));
        }

        // Simpan perubahan
        $admin->save();
        $admin->user->save();

        return redirect('/profilAdmin')->with('success', 'Profil berhasil diperbarui!');
    }
}
