<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumpulan_Tugas extends Model
{
    use HasFactory;
    protected $table = 'pengumpulan_tugas';
    protected $primaryKey = 'idpengumpulan';
    public $timestamps = false;

    protected $fillable = [
        'idpengumpulan',
        'idtugas',
        'status',
        'tanggal_pengumpulan',
        'file_submit_tugas',
        'idsiswa',
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'idsiswa');
    }
    
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'idtugas');
    }    

}
