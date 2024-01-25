<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materi';
    protected $primaryKey = 'idmateri';
    public $timestamps = false;

    protected $fillable = [
        'idmateri',
        'judul_materi',
        'file_materi',
        'tanggal_upload',
        'idkelas',
    ];

    // Definisikan relasi dengan tabel kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'idkelas');
    }
}
