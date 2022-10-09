<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Provinciaestoque extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'provinciaestoque';
    protected $fillable = ['estoque_id','pais_id','provincia_id','estado'];

    public function provincias()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }
}
