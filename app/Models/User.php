<?php

namespace App\Models;

use App\Models\Models\Endereco;
use App\Models\Models\Estoque;
use App\Models\Models\Itemestoque;
use App\Models\Models\Role;
use App\Models\Models\Telefone;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'icon',
        'name',
        'email',
        'password',
        'email_verified_at'
    ];

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
    ];

    public function estoques()
    {
        return $this->belongsToMany(Estoque::class, 'Itemestoque', 'usersFor_id', 'estoque_id');
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function telefones()
    {
        return $this->hasMany(Telefone::class, 'users_id', 'id');
    }

    public function enderecos()
    {
        return $this->hasMany(Endereco::class, 'users_id', 'id');
    }
}
