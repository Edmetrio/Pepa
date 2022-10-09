<?php

namespace App\Models\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Itemestoque extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'Itemestoque';
    protected $fillable = ['estoque_id','usersFor_id','users_id','quantidade','valor','estado'];

    public function users()
    {
        $rolec = Role::where('nome', 'admin')->first();
        return $this->belongsTo(User::class, 'users_id')->where('role_id', $rolec->id);
    }

    
    public function usersFor()
    {
        $role = Role::where('nome', 'fornecedor')->first();
        return $this->belongsTo(User::class, 'users_id')->where('role_id', $role->id);
    }

    public function estoques()
    {
        return $this->belongsTo(Estoque::class, 'estoque_id');
    }

    public function userss()
    {
        return $this->belongsTo(User::class, 'usersFor_id');
    }

    public function usersc()
    {
        return $this->belongsTo(User::class, 'users_id');
    }



    
}
