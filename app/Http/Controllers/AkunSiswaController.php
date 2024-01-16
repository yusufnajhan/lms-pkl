<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkunSiswaController extends Controller
{
    // read
    public function index()
    {
    $siswas = Siswa::all();
    $users = User::all();
    return view('admin.siswa', compact('siswas', 'users'));
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

    // edit
    public function edit(Request $request, $idsiswa)
    {
        $siswa = Siswa::where('idsiswa', $idsiswa)->first();

        $nama = $siswa->nama;
        $nik = $siswa->nik;
        $jenis_kelamin = $siswa->jenis_kelamin;
        $tanggal_lahir = $siswa->tanggal_lahir;
        $email = $siswa->email;
        $nomor_hp = $siswa->nomor_hp;

        $username = $siswa->user->username;
        $password = $siswa->user->password;

        return view("admin.editsiswa", compact('idsiswa','nama', 'nik', 'jenis_kelamin', 'tanggal_lahir',
                                                'email', 'nomor_hp', 'username'));
    }

    public function update(Request $request, $idsiswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email|max:255',
            'nomor_hp' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            Siswa::where('idsiswa', $idsiswa)->update($validated);
            DB::commit();

            return redirect()
                ->route('siswa.index')
                ->with('success', 'Akun siswa berhasil diperbarui.');

        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('siswa.index')
                ->withErrors(['error' => 'Gagal memperbarui akun siswa. Error: ' . $e->getMessage()]);
        }

        // $siswa = Siswa::find($idsiswa);
        // return view('siswa.edit', compact('siswa'));
    }
}
