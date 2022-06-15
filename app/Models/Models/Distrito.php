<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Distrito extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'distrito';
    protected $fillable = ['provincia_id','nome','estado'];

    public function pais()
    {
        return $this->belongsToMany(Pais::class, 'distrito_id');
    }
}
