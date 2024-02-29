<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'id',
        'username',
        'password',
        'idrole',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function dataPribadi()
    {
        switch ($this->idrole) {
            case 1:
                return $this->hasOne(Admin::class, 'iduser');
            case 2:
                return $this->hasOne(Guru::class, 'iduser');
            case 3:
                return $this->hasOne(Siswa::class, 'iduser');
            default:
                return null;
        }
    }
    
}

