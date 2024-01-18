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
        'id',
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

    public function admin()
    {
        return $this->hasOne(Admin::class, 'iduser');
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'iduser');
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'iduser');
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'iduser');
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'iduser');
    }
    
}

