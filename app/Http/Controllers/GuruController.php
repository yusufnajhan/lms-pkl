<?php

namespace App\Http\Controllers;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    // profil
    // public function edit(){
    //     $userID = auth()->user()->id;

    //     $guru = Guru::where('iduser', $userID)->first();

    //     $nama = $guru->nama;
    //     $nik = $guru->nik;
    //     $jenis_kelamin = $guru->jenis_kelamin;
    //     $tanggal_lahir = $guru->tanggal_lahir;
    //     $email = $guru->email;
    //     $nomor_hp = $guru->nomor_hp;

    //     $username = $guru->user->username;
    //     $password = $guru->user->password;

    //     return view("guru.profil", compact('nama', 'nik', 'jenis_kelamin', 'tanggal_lahir',
    //                                             'email', 'nomor_hp', 'username', 'password'));
    // }

    // // edit profil
    // public function edit2(Request $request)
    // {
    //     $userID = auth()->user()->id;
    //     $guru = Guru::where('iduser', $userID)->first();

    //     $nama = $guru->nama;
    //     $nik = $guru->nik;
    //     $jenis_kelamin = $guru->jenis_kelamin;
    //     $tanggal_lahir = $guru->tanggal_lahir;
    //     $email = $guru->email;
    //     $nomor_hp = $guru->nomor_hp;

    //     $username = $guru->user->username;
    //     $password = $guru->user->password;

    //     return view("guru.editprofil", compact('iduser', 'nama', 'nik', 'jenis_kelamin', 'tanggal_lahir',
    //                                             'email', 'nomor_hp', 'username', 'password'));
    // }
    // public function update(Request $request)
    // {
    //     $userID = auth()->user()->id;
    //     $validated = $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'nik' => 'required|numeric',
    //         'jenis_kelamin' => 'required|in:Pria,Wanita',
    //         'tanggal_lahir' => 'required|date',
    //         'email' => 'required|email|max:255',
    //         'nomor_hp' => 'required|numeric',
    //     ]);

    //     DB::beginTransaction();
    //     try {
    //         Siswa::where('iduser', $userID)->update($validated);
    //         DB::commit();

    //         return redirect()
    //             ->route('guru.edit')
    //             ->with('success', 'Akun siswa berhasil diperbarui.');

    //     }

    //     catch (\Exception $e) 
    //     {
    //         DB::rollBack();
    //         return redirect()
    //             ->route('guru.edit')
    //             ->withErrors(['error' => 'Gagal memperbarui akun siswa. Error: ' . $e->getMessage()]);
    //     }

    //     // $siswa = Siswa::find($idguru);
    //     // return view('siswa.edit', compact('siswa'));
    // }


    // edit profil 
    public function edit(Request $request)
    {
        $user = $request->user();
        // $idguru = $request->user()->guru->idguru;
        $idguru = $request->user()->dataPribadi->idguru;

        $guru = Guru::where('idguru', $idguru)->first();

        return view('guru.profil', ['user' => $user, 'guru' => $guru]);
    }

    public function showEdit(Request $request)
    {
        $user = $request->user();
        // $idguru = $request->user()->guru->idguru;
        $idguru = $request->user()->dataPribadi->idguru;
        
        $guru = Guru::where('idguru', $idguru)->first();
        return view('guru.editprofil', ['user' => $user, 'guru' => $guru]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        // $idguru = $request->user()->guru->idguru;
        $idguru = $request->user()->dataPribadi->idguru;

        $validated = $request->validate([
            'nomor_hp' => 'required|numeric',
            'email' => 'required|email|max:255',
            'username' => 'nullable|string',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8',
            'new_confirm_password' => 'nullable|same:new_password',
        ]);

        // Check if 'new_password' key exists and not null in $validated
        if (array_key_exists('new_password', $validated) && $validated['new_password'] !== null) {
            if (!Hash::check($validated['current_password'], $user->password)) {
                return redirect()
                    ->route('showEdit2')
                    ->with('error', 'Kata sandi lama tidak cocok');
            }
        }

        DB::beginTransaction();

        try {
            $userData = [
                'nomor_hp' => $validated['nomor_hp'],
                'email' => $validated['email'],
                'username' => $validated['username'] ?? null,
            ];

            $guruData = [
                'nomor_hp' => $validated['nomor_hp'],
                'email' => $validated['email'],
            ];

            if (!is_null($userData['username'])) {
                $user->update($userData);
            }

            if (array_key_exists('new_password', $validated) && $validated['new_password'] !== null) {
                $user->update([
                    'password' => Hash::make($validated['new_password']),
                ]);
            }

            Guru::where('idguru', $idguru)->update($guruData);

            DB::commit();

            return redirect()
                ->route('edit2')
                ->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('showEdit2')
                ->with('error', 'Gagal memperbarui profil.');
        }
    }

}
