<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanKuis extends Model
{
    protected $fillable = [
        'iduser',
        'idkuis',
        'idquestions',
        'answer',
    ];

    public function questions()
    {
        return $this->belongsTo(Question::class, 'idquestions');
    }

    use HasFactory;
}
