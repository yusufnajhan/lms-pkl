<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'idguru';
    public $timestamps = false;

    // Relationship dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
