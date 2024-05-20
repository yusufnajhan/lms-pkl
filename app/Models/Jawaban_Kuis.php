<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban_Kuis extends Model
{
    use HasFactory;
    protected $table = 'jawaban_kuis';
    protected $primaryKey = 'idjawaban';
    public $timestamps = false;

    protected $fillable = [
        'idsoal',
        'status',
        'tanggal_pengumpulan',
        'jawaban',
        'idsiswa',
        // 'nilai', // kolom baru untuk nilai
        // 'idguru', // kolom baru untuk id guru
        'idkuis', // kolom baru untuk id kuis
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'idsiswa');
    }
    
    public function soalkuis()
    {
        return $this->belongsTo(Soal_Kuis::class, 'idsoal');
    } 
    
    // public function guru()
    // {
    //     return $this->belongsTo(Guru::class, 'idguru'); // relasi baru ke model Guru
    // }
    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'idkuis');
    } 
}
