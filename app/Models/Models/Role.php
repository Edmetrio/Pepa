<?php

namespace App\Models\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Role extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'role';
    protected $fillable = ['nome','estado'];

    public function rotas()
    {
        return $this->belongsToMany(Rota::class, 'permissao');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'role_id');
    }
}
