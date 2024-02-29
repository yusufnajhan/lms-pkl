<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Pengumpulan_Tugas extends Model
{
    use HasFactory, Sortable;
    protected $table = 'pengumpulan_tugas';
    protected $primaryKey = 'idpengumpulan';
    public $timestamps = false;

    protected $fillable = [
        // 'idpengumpulan',
        'idtugas',
        'status',
        'tanggal_pengumpulan',
        'file_submit_tugas',
        'idsiswa',
        'nilai', // kolom baru untuk nilai
        'idguru', // kolom baru untuk id guru
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'idsiswa');
    }
    
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'idtugas');
    } 
    
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'idguru'); // relasi baru ke model Guru
    }

}
