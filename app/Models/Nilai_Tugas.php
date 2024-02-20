<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai_Tugas extends Model
{
    use HasFactory;
    protected $table = 'nilai_tugas';
    protected $primaryKey = 'idnilai';
    public $timestamps = false;

    protected $fillable = [
        'idnilai',
        'nilai',
        'tanggal_penilaian',
        'idguru',
    ];
}
