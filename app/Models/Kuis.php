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

    protected $dates = [
        'tanggal_mulai', 'tanggal_selesai'
    ];
    // atau
    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];
    

    protected $fillable = [
        'idkuis',
        'judul_kuis',
        'deskripsi_kuis',
        'tanggal_mulai',
        'tanggal_selesai',
        'jumlah_soal',
        'idkelas',
    ];

    // Definisikan relasi dengan tabel kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'idkelas');
    }

    public function soalkuis()
    {
        return $this->hasMany(Soal_Kuis::class, 'idkuis');
    }

    // public function questions()
    // {
    //     return $this->hasMany(Question::class, 'idkuis');
    // }

    // public function show($idkuis)
    // {
    //     $esais = Esai::where('idkuis', $idkuis)->get();

    //     return view('esai.index', compact('esais'));
    // }

}
