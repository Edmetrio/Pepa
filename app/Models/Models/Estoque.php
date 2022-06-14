<?php

namespace App\Models\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Estoque extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'estoque';
    protected $fillable = ['produto_id','quantidade','pais_id','distrito_id','estado'];

    public function produtos()
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'Itemestoque', 'estoque_id', 'usersFor_id');
    }
}
