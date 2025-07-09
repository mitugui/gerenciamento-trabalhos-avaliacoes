<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    function role()
    {
        return $this->belongsTo(Role::class);
    }

    function professor()
    {
        return $this->hasOne(Professor::class);
    }

    function aluno()
    {
        return $this->hasOne(Aluno::class);
    }

    function eventos()
    {
        return $this->hasMany(Evento::class);
    }

    public function isAluno(): bool
    {
        return strtolower($this->role->nome) === strtolower('aluno');
    }

    public function isProfessor(): bool
    {
        return strtolower($this->role->nome) === strtolower('professor');
    }

    public function isAdmin(): bool
    {
        return strtolower($this->role->nome) === strtolower('admin');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
