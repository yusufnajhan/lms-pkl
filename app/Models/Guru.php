<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $primaryKey = 'idguru';
    public $timestamps = false;

    protected $fillable = [
        'idguru',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'nik',
        'email',
        'nomor_hp',
        'iduser'
    ];

    // Definisikan relasi dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

    public function kelass()
    {
        return $this->hasMany(Kelas::class, 'idguru');
    }
}
