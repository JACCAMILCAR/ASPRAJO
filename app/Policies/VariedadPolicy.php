<?php

namespace App\Policies;

use App\User;
use App\Variedad;
use Illuminate\Auth\Access\HandlesAuthorization;

class VariedadPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Variedad  $variedad
     * @return mixed
     */
    public function view(User $user, Variedad $variedad)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'ver-variedad')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'crear-variedad')) {
            return true;
        }
        return false;
    }
     /**
     * Undocumented function
     *
     * @param User $user
     * @param Variedad $variedad
     * @return void
     */
    public function edit(User $user, Variedad $variedad)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'actualizar-variedad')) {
            return true;
        }
        return false;
    
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Variedad  $variedad
     * @return mixed
     */
    public function update(User $user, Variedad $variedad)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'actualizar-variedad')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Variedad  $variedad
     * @return mixed
     */
    public function delete(User $user, Variedad $variedad)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'eliminar-variedad')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Variedad  $variedad
     * @return mixed
     */
    public function restore(User $user, Variedad $variedad)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Variedad  $variedad
     * @return mixed
     */
    public function forceDelete(User $user, Variedad $variedad)
    {
        //
    }
}
