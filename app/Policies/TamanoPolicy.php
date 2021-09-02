<?php

namespace App\Policies;

use App\Tamano;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TamanoPolicy
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
     * @param  \App\Tamano  $tamano
     * @return mixed
     */
    public function view(User $user, Tamano $tamano)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'ver-tamano')) {
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
        } elseif ($user->permisos->contains('slug', 'crear-tamano')) {
            return true;
        }
        return false;
    }
    /**
     * Undocumented function
     *
     * @param User $user
     * @param Categoria $categoria
     * @return void
     */
    public function edit(User $user, Tamano $tamano)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'actualizar-tamano')) {
            return true;
        }
        return false;
    
    }
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tamano  $tamano
     * @return mixed
     */
    public function update(User $user, Tamano $tamano)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'actualizar-tamano')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tamano  $tamano
     * @return mixed
     */
    public function delete(User $user, Tamano $tamano)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'eliminar-tamano')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tamano  $tamano
     * @return mixed
     */
    public function restore(User $user, Tamano $tamano)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tamano  $tamano
     * @return mixed
     */
    public function forceDelete(User $user, Tamano $tamano)
    {
        //
    }
}
