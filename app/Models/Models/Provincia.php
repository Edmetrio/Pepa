<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Provincia extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'provincia';
    protected $fillable = ['pais_id','nome','estado'];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'estoque')->withPivot('provincia_id','pais_id', 'distrito_id');
    }
    
}
