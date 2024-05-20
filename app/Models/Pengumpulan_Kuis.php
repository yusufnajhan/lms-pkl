<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumpulan_Kuis extends Model
{
    use HasFactory;
    protected $table = 'pengumpulan_kuis';
    protected $primaryKey = 'idpengumpulan';
    public $timestamps = false;

    protected $fillable = [
        // 'idpengumpulan',
        'idkuis',
        'idsiswa',
        'nilai', // kolom baru untuk nilai
        'idguru', // kolom baru untuk id guru
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'idsiswa');
    }
    
    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'idkuis');
    } 
    
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'idguru'); // relasi baru ke model Guru
    }
}
