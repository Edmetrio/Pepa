<?php

namespace App\Models\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Extensionistafornecedor extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'extensionistafornecedor';
    protected $fillable = ['extensionista_id','users_id','situacao_id','descricao','estado'];

    public function extensionistas()
    {
        return $this->belongsTo(Extensionista::class, 'extensionista_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function situacaos()
    {
        return $this->belongsTo(Situacao::class, 'situacao_id');
    }

}
