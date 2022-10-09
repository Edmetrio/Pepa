<?php

namespace App\Models\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Telefone extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'telefone';
    protected $fillable = ['users_id','carteira_id','numero','estado'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function carteiras()
    {
        return $this->belongsTo(Carteira::class, 'carteira_id', 'id');
    }
}
