<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    // edit profil 
    public function edit(Request $request)
    {
        $user = $request->user();
        $idsiswa = $request->user()->siswa->idsiswa;

        $siswa = Siswa::where('idsiswa', $idsiswa)->first();

        return view('siswa.profil', ['user' => $user, 'siswa' => $siswa]);
    }

    public function showEdit(Request $request)
    {
        $user = $request->user();
        $idsiswa = $request->user()->siswa->idsiswa;
        
        $siswa = Siswa::where('idsiswa', $idsiswa)->first();
        return view('siswa.editprofil', ['user' => $user, 'siswa' => $siswa]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $idsiswa = $request->user()->siswa->idsiswa;

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
                    ->route('showEdit3')
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

            $siswaData = [
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

            Siswa::where('idsiswa', $idsiswa)->update($siswaData);

            DB::commit();

            return redirect()
                ->route('edit3')
                ->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('showEdit3')
                ->with('error', 'Gagal memperbarui profil.');
        }
    }
}
