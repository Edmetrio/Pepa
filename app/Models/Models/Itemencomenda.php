<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Support\Facades\Auth;

class Itemencomenda extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'itemencomenda';
    protected $fillable = ['encomenda_id','produto_id','distrito_id','endereco_id','unidade_id','quantidade','transporte','estado'];

    public function encomendas()
    {
        return $this->belongsTo(Encomenda::class, 'encomenda_id', 'id')->where('users_id', Auth::user()->id);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function produtos()
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }

    public function distritos()
    {
        return $this->belongsTo(Distrito::class, 'distrito_id', 'id');
    }

    public function enderecos()
    {
        return $this->hasMany(Endereco::class, 'id', 'endereco_id');
    }

    public function unidades()
    {
        return $this->belongsTo(Unidade::class, 'unidade_id', 'id');
    }
}
