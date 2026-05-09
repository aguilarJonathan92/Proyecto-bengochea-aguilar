<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User;

class UsuarioPerfil extends Model
{
    protected $table = 'usuario_perfil';

    protected $fillable = [
        'usuario_id',
        'telefono',
        'direccion',
    ];

    //Un perfil solo pertenece a un usuario
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}