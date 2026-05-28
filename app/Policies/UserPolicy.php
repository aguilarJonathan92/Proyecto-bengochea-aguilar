<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models. (Solo el admin puede ver todos los usuarios)
     */
    public function viewAny(User $user): bool
    {
        return $user->role->name === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->role->name === 'admin';
    }

    /**
     * Determine whether the user can create models.
     * en true para que los clientes puedan registrarse en la web pública.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // 1. Si el usuario que intenta editar no es administrador, se le niega el acceso al panel
        if ($user->role->name !== 'admin') {
            return false;
        }

        // 2. Si es administrador, se le permite abrir el formulario.
        // Las restricciones de nombre, apellido y correo ya las maneja el UserForm con ->disabled()
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        //El administrador puede eliminar usuarios, excepto a sí mismo para no perder el acceso
        return $user->role->name === 'admin' && $user->id !== $model->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
