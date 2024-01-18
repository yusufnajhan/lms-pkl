<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    // edit profil 
    public function edit(Request $request)
    {
        $user = $request->user();
        $idadmin = $request->user()->admin->idadmin;

        $admin = Admin::where('idadmin', $idadmin)->first();

        return view('admin.profil', ['user' => $user, 'admin' => $admin]);
    }

    public function showEdit(Request $request)
    {
        $user = $request->user();
        $idadmin = $request->user()->admin->idadmin;
        
        $admin = Admin::where('idadmin', $idadmin)->first();
        return view('admin.editprofil', ['user' => $user, 'admin' => $admin]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $idadmin = $request->user()->admin->idadmin;

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
                    ->route('showEdit1')
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

            $adminData = [
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

            Admin::where('idadmin', $idadmin)->update($adminData);

            DB::commit();

            return redirect()
                ->route('edit1')
                ->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->route('showEdit1')
                ->with('error', 'Gagal memperbarui profil.');
        }
    }
}
