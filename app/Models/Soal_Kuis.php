<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal_Kuis extends Model
{
    use HasFactory;
    protected $table = 'soal_kuis';
    protected $primaryKey = 'idsoal';
    public $timestamps = false;

    protected $fillable = [
        'pertanyaan',
        'jawaban',
        'idkuis',
    ];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'idkuis');
    } 
}