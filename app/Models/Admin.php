<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'idadmin';
    public $timestamps = false;

    // Relationship dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}
