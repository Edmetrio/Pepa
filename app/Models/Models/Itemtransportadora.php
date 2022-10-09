<?php

namespace App\Models\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Itemtransportadora extends Model
{
    use HasFactory, Uuid;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    protected $table = 'itemtransportadora';
    protected $fillable = ['users_id','transportadora_id','situacaotrans_id','estado'];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function transportadoras()
    {
        return $this->belongsTo(Transportadora::class, 'transportadora_id');
    }

    public function situacaos()
    {
        return $this->belongsTo(Situacaotrans::class, 'situacaotrans_id');
    }
}
