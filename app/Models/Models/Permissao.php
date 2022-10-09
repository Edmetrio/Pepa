<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class Permissao extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'permissao';
    protected $fillable = ['role_id','rota_id','estado'];

    public function roles()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    public function rotas()
    {
        return $this->belongsTo(Rota::class, 'rota_id');
    }

    public static function isRoleHasRightToAccess($user, $route)
    {
        try { 
            $model = static::where('role_id', $user)
                    ->where('rota_id', $route)
                    ->first();
                    
            return $model ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
