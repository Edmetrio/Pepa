<?php

namespace App\Models\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Itemcarrinha extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'itemcarrinha';
    protected $fillable = ['users_id','produto_id','distrito_id','endereco_id','unidade_id','quantidade','transporte','estado'];

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
