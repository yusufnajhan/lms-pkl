<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'idcomment';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'iduser',
        'iddiskusi', 
        'idparent', 
        'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
    /**
    * The has Many Relationship
    *
    * @var array
    */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'idparent');
    }

}
