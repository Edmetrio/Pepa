<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Noticia extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'noticia';
    protected $fillable = ['nome','icon','descricao','simbolo','link','estado'];

    public function noticiacomentarios()
    {
        return $this->hasMany(Noticiacomentario::class, 'id', 'noticia_id');
    }
}
