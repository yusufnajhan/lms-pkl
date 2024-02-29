<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'enrollment';
    protected $primaryKey = 'idenroll';
    public $timestamps = false;

    protected $fillable = [
        // 'idenroll',
        'tanggal_enroll',
        'idsiswa',
        'idkelas'
    ];

    // Definisikan relasi dengan tabel siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'idsiswa');
    }

    // Definisikan relasi dengan tabel kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'idkelas');
    }

}
