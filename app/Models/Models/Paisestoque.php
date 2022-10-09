<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Paisestoque extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'paisestoque';
    protected $fillable = ['estoque_id','pais_id','estado'];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }
}
