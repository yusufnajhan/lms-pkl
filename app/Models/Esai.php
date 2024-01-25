<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Esai extends Model
{
    use HasFactory;
    protected $table = 'esai';
    protected $primaryKey = 'idesai';
    public $timestamps = true;

    protected $fillable = [
        'idkuis',
        'soal',
        'idesai',
    ];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'idkuis');
    }
}
