<?php

namespace App\Policies;

use App\User;
use App\Venta;
use Illuminate\Auth\Access\HandlesAuthorization;

class VentaPolicy
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
     * @param  \App\Venta  $venta
     * @return mixed
     */
    public function view(User $user, Venta $venta)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'ver-venta')) {
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
        } elseif ($user->permisos->contains('slug', 'crear-venta')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Venta  $venta
     * @return mixed
     */
    public function update(User $user, Venta $venta)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'actualizar-venta')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Venta  $venta
     * @return mixed
     */
    public function delete(User $user, Venta $venta)
    {
        if($user->rols->contains('slug', 'administrador')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'eliminar-venta')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Venta  $venta
     * @return mixed
     */
    public function restore(User $user, Venta $venta)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Venta  $venta
     * @return mixed
     */
    public function forceDelete(User $user, Venta $venta)
    {
        //
    }
}
