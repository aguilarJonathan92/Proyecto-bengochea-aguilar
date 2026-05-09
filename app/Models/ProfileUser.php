<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProfileUser extends Model
{
    protected $table = 'profile_user';

    protected $fillable = [
        'user_id',
        'phone',
        'address',
    ];

    //Un perfil solo pertenece a un usuario
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}