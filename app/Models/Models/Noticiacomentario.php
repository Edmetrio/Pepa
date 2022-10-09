<?php

namespace App\Models\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Noticiacomentario extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'noticiacomentario';
    protected $fillable = ['users_id','noticia_id','mensagem','estado'];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
