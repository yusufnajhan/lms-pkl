<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'idsiswa';
    public $timestamps = false;

    // Relationship dengan tabel users
    public function user()
    {
        return $this->belongsTo(Users::class, 'iduser');
    }
}
