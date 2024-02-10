<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskusi extends Model
{
    use HasFactory;
    protected $table = 'diskusi';
    protected $primaryKey = 'iddiskusi';
    public $timestamps = false;

    protected $fillable = [
        'iddiskusi',
        'judul_diskusi',
        'deskripsi_diskusi',
        'tanggal_upload',
        'idkelas',
    ];

    // Definisikan relasi dengan tabel kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'idkelas');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'iddiskusi')->whereNull('idparent');
    }

}
