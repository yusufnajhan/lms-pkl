<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'idsiswa';
    public $timestamps = false;

    protected $fillable = [
        'idsiswa',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'nik',
        'email',
        'nomor_hp',
        'iduser'
    ];

    // Relationship dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    // Relationship with Kelas through Enrollment
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'enrollment', 'idsiswa', 'idkelas', 'idsiswa', 'idkelas');
    }
    
}
