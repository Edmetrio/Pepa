<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;


class Produto extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'produto';
    protected $fillable = ['categoria_id','nome','icon','descricao','preco_retalho','preco_grosso','estado'];

    public function categorias()
    {
        return $this->hasOne(Categoria::class, 'id', 'categoria_id');
    }

    public function provincias()
    {
        return $this->belongsToMany(Provincia::class, 'estoque');
    }

    public function distritos()
    {
        return $this->belongsToMany(Distrito::class, 'estoque', 'produto_id','distrito_id');
    }

    
}
