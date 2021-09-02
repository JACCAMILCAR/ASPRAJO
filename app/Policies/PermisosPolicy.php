<?php

namespace App\Policies;

use App\Permisos;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermisosPolicy
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
     * @param  \App\Permisos  $permisos
     * @return mixed
     */
    public function view(User $user, Permisos $permisos)
    {
        if($user->rols->contains('slug', 'presidente')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'ver-permiso')) {
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
        if($user->rols->contains('slug', 'presidente')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'crear-permiso')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Permisos  $permisos
     * @return mixed
     */
    public function update(User $user, Permisos $permisos)
    {
        if($user->rols->contains('slug', 'presidente')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'actualizar-permiso')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Permisos  $permisos
     * @return mixed
     */
    public function delete(User $user, Permisos $permisos)
    {
        if($user->rols->contains('slug', 'presidente')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'eliminar-permiso')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Permisos  $permisos
     * @return mixed
     */
    public function restore(User $user, Permisos $permisos)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Permisos  $permisos
     * @return mixed
     */
    public function forceDelete(User $user, Permisos $permisos)
    {
        //
    }
}
