<?php

namespace App\Policies;

use App\UnidadMedida;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UnidadMedidaPolicy
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
      
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\UnidadMedida  $unidadMedida
     * @return mixed
     */
    public function view(User $user, UnidadMedida $unidadMedida)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'ver-unidadmedida')) {
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
        } elseif ($user->permisos->contains('slug', 'crear-unidadmedida')) {
            return true;
        }
        return false;
    }
    /**
     * Undocumented function
     *
     * @param User $user
     * @param UnidadMedida $unidadMedida
     * @return void
     */
    public function edit(User $user, UnidadMedida $unidadMedida)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'actualizar-unidadmedida')) {
            return true;
        }
        return false;
    
    }
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\UnidadMedida  $unidadMedida
     * @return mixed
     */
    public function update(User $user, UnidadMedida $unidadMedida)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'actualizar-unidadmedida')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\UnidadMedida  $unidadMedida
     * @return mixed
     */
    public function delete(User $user, UnidadMedida $unidadMedida)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'eliminar-unidadmedida')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\UnidadMedida  $unidadMedida
     * @return mixed
     */
    public function restore(User $user, UnidadMedida $unidadMedida)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\UnidadMedida  $unidadMedida
     * @return mixed
     */
    public function forceDelete(User $user, UnidadMedida $unidadMedida)
    {
        //
    }
}
