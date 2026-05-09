<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User;

class Rol extends Model
{
    protected $table = 'rols';

    //un rol pueden tener muchos usuarios
    public function Usuarios(): HasMany{
        return $this->hasMany(User::class, 'rol_id');
    }
}