<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable=['question', 'idkuis'];

    public function quiz()
    {
        return $this->belongsTo(Kuis::class, 'idkuis');
    }
    
    public function answers(){
        return $this->hasMany(Answer::class, 'question_id');
    }
}
