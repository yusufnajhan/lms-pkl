<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Tugas extends Model
{
    use HasFactory, Sortable;
    protected $table = 'tugas';
    protected $primaryKey = 'idtugas';
    public $timestamps = false;

    protected $fillable = [
        // 'idtugas',
        'judul_tugas',
        'deskripsi_tugas',
        'file_tugas',
        'tanggal_mulai',
        'tanggal_selesai',
        'idkelas',
    ];

    // Definisikan relasi dengan tabel kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'idkelas');
    }

    public function pengumpulanTugas()
    {
        return $this->hasMany(Pengumpulan_Tugas::class, 'idtugas');
    }

}
