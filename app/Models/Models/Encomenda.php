<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Encomenda extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'encomenda';
    protected $fillable = ['users_id','formapagamento_id','moeda_id','numero','valor','estado'];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'itemencomenda', 'encomenda_id', 'produto_id')->withPivot(['quantidade']);
    }
}
