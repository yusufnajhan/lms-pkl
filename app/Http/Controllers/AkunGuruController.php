<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AkunGuruController extends Controller
{
    // read
    public function index()
    {
    $gurus = Guru::all();
    $users = User::all();
    return view('admin.guru', compact('gurus', 'users'));
    }

    // add
    public function store(Request $request)
    {
    // Validasi data input
    $request->validate([
        'idguru' => 'required|numeric',
        'nama' => 'required|string|max:255',
        'nik' => 'required|numeric',
        'jenkel' => 'required|in:Pria,Wanita',
        'tgllahir' => 'required|date',
        'email' => 'required|email|max:255',
        'nohp' => 'required|numeric',
        'iduser' => 'required|numeric',
        'username' => 'required|string|unique:users',
        'password' => 'required|string',
    ]);

    // Simpan data user ke dalam database
    $user = User::create([
        'username' => $request->input('username'),
        'password' => bcrypt($request->input('password')),
        'idrole' => 2, // ID untuk role guru
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
        'iduser' => $user->id,
    ]);

    

    // Redirect atau kembalikan respons sesuai kebutuhan
    return redirect()->route('guru.index')->with('success', 'Akun guru berhasil ditambahkan.');
    }

    // edit
    public function edit(Request $request, $idguru)
    {
        $guru = Guru::where('idguru', $idguru)->first();

        $nama = $guru->nama;
        $nik = $guru->nik;
        $jenis_kelamin = $guru->jenis_kelamin;
        $tanggal_lahir = $guru->tanggal_lahir;
        $email = $guru->email;
        $nomor_hp = $guru->nomor_hp;

        $username = $guru->user->username;
        $password = $guru->user->password;

        return view("admin.editguru", compact('idguru','nama', 'nik', 'jenis_kelamin', 'tanggal_lahir',
                                                'email', 'nomor_hp', 'username'));
    }

    public function update(Request $request, $idguru)
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
            Guru::where('idguru', $idguru)->update($validated);
            DB::commit();

            return redirect()
                ->route('guru.index')
                ->with('success', 'Akun guru berhasil diperbarui.');

        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('guru.index')
                ->withErrors(['error' => 'Gagal memperbarui akun guru. Error: ' . $e->getMessage()]);
        }

        // $guru = Guru::find($idguru);
        // return view('guru.edit', compact('guru'));
    }

    // delete
    public function destroy(Request $request, $idguru)
    {
        DB::beginTransaction();

        try {
            // Find the guru by ID and delete
            $guru = Guru::findOrFail($idguru);
            $guru->user()->delete(); // Delete related user record
            $guru->delete();

            DB::commit();

            return redirect()->route('guru.index')->with('success', 'Akun guru berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('guru.index')
                ->withErrors(['error' => 'Gagal menghapus akun guru. Error: ' . $e->getMessage()]);
        }
    }

}
