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
    return view('admin.guru', compact('gurus'));
    }

    public function create()
    {
        return view('admin.tambahguru');
    }

    // add
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'idguru' => 'required|numeric',
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'tanggal_lahir' => 'required|date',
            'email' => 'required|email|max:255',
            'nomor_hp' => 'required|numeric',
            'iduser' => 'required|numeric',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
        ]);

        DB::beginTransaction();
        try 
        {
            // Simpan data user ke dalam database
            $user = User::create([
                'id' => $request->input('iduser'),
                'username' => $request->input('username'),
                'password' => bcrypt($request->input('password')),
                'idrole' => 2, // ID untuk role guru
            ]);

            // Simpan data guru ke dalam database
            Guru::create([
                'idguru' => $request->input('idguru'),
                'nama' => $request->input('nama'),
                'nik' => $request->input('nik'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'email' => $request->input('email'),
                'nomor_hp' => $request->input('nomor_hp'),
                'iduser' => $request->input('iduser'),
            ]);

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('guru.index')->with('success', 'Akun guru berhasil ditambahkan.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('guru.index')
                ->with(['error' => 'Gagal menambah akun guru. Error: ' . $e->getMessage()]);
        }
    
    
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

    public function search(Request $request) 
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $gurus = Guru::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })->get();
        }

        return view('admin.guru', ['gurus' => $gurus]);
    }

    // delete
    public function destroy($idguru)
    {
        $guru = Guru::where('idguru', $idguru)->first();

        if ($guru){

            $userId = $guru->iduser;   

            $guru->delete();

            $user = User::find($userId);
            if ($user) {
                $user->delete();
            }

            return redirect()->route('guru.index')->with('success', 'Akun guru berhasil dihapus.');
        }
        else{
            return redirect()
                ->route('guru.index')
                ->withErrors('error', 'Gagal menghapus akun guru.');
        
        }
    }

}
