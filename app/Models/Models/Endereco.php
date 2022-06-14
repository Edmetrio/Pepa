<?php

namespace App\Models\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Endereco extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'endereco';
    protected $fillable = ['users_id','distrito_id','nome','estado'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function distritos()
    {
        return $this->belongsTo(Distrito::class, 'distrito_id', 'id');
    }
}
