<?php

namespace App\Models;

use CreateSoalEsai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SoalEsai;

class Kuis extends Model
{
    use HasFactory;
    protected $table = 'kuis';
    protected $primaryKey = 'idkuis';
    public $timestamps = false;

    protected $fillable = [
        'idkuis',
        'judul_kuis',
        'deskripsi_kuis',
        'tanggal_mulai',
        'tanggal_selesai',
        'idkelas',
    ];

    // Definisikan relasi dengan tabel kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'idkelas');
    }
}
