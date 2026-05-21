<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser; // La interfaz
use Filament\Panel;                         // La clase Panel que espera el método
use Illuminate\Foundation\Auth\User as Authenticatable;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

#[Fillable(['last_name', 'first_name', 'email', 'password', 'role_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    public function canAccessPanel(Panel $panel): bool
    {
        // Solo el role_id 1 tiene permiso de entrar a /admin
        return $this->role && $this->role->name === 'admin';
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    //Un usuario se relaciona con un carrito
    public function cart(){
        return $this->hasOne(Cart::class);
    }

    //Un usuario puede tener muchas ordenes (falta el modelo)
    public function order(){}

    //Necesario ya que filament usa 'name' y en la bd no uso ese
    public function getNameAttribute(): string
    {
        return "{$this->last_name} {$this->first_name}";
    }
}
