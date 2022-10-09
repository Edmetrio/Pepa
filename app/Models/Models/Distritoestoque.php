<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Distritoestoque extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'distritoestoque';
    protected $fillable = ['estoque_id','pais_id','distrito_id','provincia_id','produto_id','estado'];

    public function distritos()
    {
        return $this->belongsTo(Distrito::class, 'distrito_id');
    }
}
