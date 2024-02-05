<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'idkelas';
    public $timestamps = false;

    protected $fillable = [
        'idkelas',
        'mata_pelajaran',
        'indeks_kelas',
        'jenjang_kelas',
        'tanggal_dibuat',
        'tanggal_tutup',
        'idguru'
    ];

    // Definisikan relasi dengan tabel guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'idguru');
    }

    // Relationship with Siswa through Enrollment
    public function siswas()
    {
        return $this->belongsToMany(Siswa::class, 'enrollment', 'idkelas', 'idsiswa', 'idkelas', 'idsiswa');
    }

}
