<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Carteira extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'carteira';
    protected $fillable = ['nome','estado'];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class, 'id', 'carteira_id');
    }
}
