<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'rol_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    //un usuario solo tiene un rol
    public function rol(): BelongsTo{
        return $this->belongsTo(Rol::class, 'rol_id');
    }
    
    public function perfil(): HasOne{
        return $this->hasOne(ProfileUser::class, 'user_id');
    }
    //esto todavia no lo uso, lo deje aca porque me creó el comando
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
