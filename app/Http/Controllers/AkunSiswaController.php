<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Jawaban_Kuis;
use App\Models\Pengumpulan_Tugas;
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
    return view('admin.siswa', compact('siswas'));
    }

    public function create()
    {
        return view('admin.tambahsiswa');
    }

    // add
    public function store(Request $request)
    {
    // Validasi data input
    $request->validate([
        // 'idsiswa' => 'required|numeric',
        'nama' => 'required|string|max:255',
        'nik' => 'required|string|max:20|unique:siswa,nik',
        'jenis_kelamin' => 'required|in:Pria,Wanita',
        'tanggal_lahir' => 'required|date',
        'email' => 'required|email|max:255',
        'nomor_hp' => 'required|string|max:15',
        // 'iduser' => 'required|numeric',
        'username' => 'required|string|unique:users',
        'password' => 'required|string',
    ]);

    DB::beginTransaction();
        try 
        {
            // Simpan data user ke dalam database
            $user = User::create([
                // 'id' => $request->input('iduser'),
                'username' => $request->input('username'),
                'password' => bcrypt($request->input('password')),
                'idrole' => 3, // ID untuk role siswa
            ]);

            // Simpan data siswa ke dalam database
            Siswa::create([
                // 'idsiswa' => $request->input('idsiswa'),
                'nama' => $request->input('nama'),
                'nik' => $request->input('nik'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'email' => $request->input('email'),
                'nomor_hp' => $request->input('nomor_hp'),
                'iduser' => $user->id,
            ]);

            DB::commit();
            // Redirect atau kembalikan respons sesuai kebutuhan
            return redirect()->route('siswa.index')->with('success', 'Akun siswa berhasil ditambahkan.');
        }

        catch (\Exception $e) 
        {
            DB::rollBack();
            return redirect()
                ->route('siswa.index')
                ->with(['error' => 'Gagal menambah akun siswa. Error: ' . $e->getMessage()]);
        }
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

    public function search(Request $request) 
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $siswas = Siswa::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })->get();
        }

        return view('admin.siswa', ['siswas' => $siswas]);
    }


    // delete
    // public function destroy($idsiswa)
    // {
    //     $siswa = Siswa::where('idsiswa', $idsiswa)->first();

    //     if ($siswa){
    //         $userId = $siswa->iduser; 

    //         // Delete all enrollments for the siswa
    //         Enrollment::where('idsiswa', $idsiswa)->delete();

    //         $siswa->delete();

    //         $user = User::find($userId);
    //         if ($user) {
    //             $user->delete();
    //         }

    //         return redirect()->route('siswa.index')->with('success', 'Akun siswa berhasil dihapus.');
    //     }
    //     else{
    //         return redirect()
    //             ->route('siswa.index')
    //             ->withErrors('error', 'Gagal menghapus akun siswa.');
        
    //     }
    // }
    // public function destroy($idsiswa)
    // {
    //     $siswa = Siswa::where('idsiswa', $idsiswa)->first();

    //     if ($siswa) {
    //         // Delete all related jawaban_kuis records first
    //         Jawaban_Kuis::where('idsiswa', $idsiswa)->delete();

    //         // Delete all related enrollment records first
    //         Enrollment::where('idsiswa', $idsiswa)->delete();

    //         // Delete all related pengumpulan_tugas records first
    //         Pengumpulan_Tugas::where('idsiswa', $idsiswa)->delete();

    //         // Delete the siswa record
    //         $siswa->delete();

    //         // Also delete the associated user record (if exists)
    //         $user = User::find($siswa->iduser);
    //         if ($user) {
    //             $user->delete();
    //         }

    //         return redirect()->route('siswa.index')->with('success', 'Akun siswa berhasil dihapus.');
    //     } else {
    //         return redirect()->route('siswa.index')->withErrors('error', 'Gagal menghapus akun siswa.');
    //     }
    // }
    // public function destroy($idsiswa)
    // {
    //     $siswa = Siswa::where('idsiswa', $idsiswa)->first();

    //     if ($siswa) {
    //         // Hapus semua catatan terkait di tabel enrollment, jawaban_kuis, dan pengumpulan_tugas
    //         Enrollment::where('idsiswa', $idsiswa)->delete();
    //         Jawaban_Kuis::where('idsiswa', $idsiswa)->delete();
    //         Pengumpulan_Tugas::where('idsiswa', $idsiswa)->delete();

    //         // Hapus catatan siswa
    //         $siswa->delete();

    //         // Juga hapus catatan pengguna yang terkait (jika ada)
    //         $user = User::find($siswa->iduser);
    //         if ($user) {
    //             $user->delete();
    //         }

    //         return redirect()->route('siswa.index')->with('success', 'Akun siswa berhasil dihapus.');
    //     } else {
    //         return redirect()->route('siswa.index')->withErrors('error', 'Gagal menghapus akun siswa.');
    //     }
    // }

    public function destroy($idsiswa)
    {
        
        DB::beginTransaction();
        try {

            // Hapus semua catatan terkait di tabel enrollment, jawaban_kuis, dan pengumpulan_tugas
            Enrollment::where('idsiswa', $idsiswa)->delete();
            Jawaban_Kuis::where('idsiswa', $idsiswa)->delete();
            Pengumpulan_Tugas::where('idsiswa', $idsiswa)->delete();

            // Hapus catatan siswa
            $siswa = Siswa::find($idsiswa);
            if ($siswa) {
                $siswa->delete();

                // Juga hapus catatan pengguna yang terkait (jika ada)
                $user = User::find($siswa->iduser);
                if ($user) {
                    $user->delete();
                }

                DB::commit();
                return redirect()->route('siswa.index')->with('success', 'Akun siswa berhasil dihapus.');
            } else {
                DB::rollback();
                return redirect()->route('siswa.index')->withErrors('error', 'Gagal menghapus akun siswa.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('siswa.index')->withErrors('error', 'Terjadi kesalahan saat menghapus akun siswa.');
        }
    }



}
