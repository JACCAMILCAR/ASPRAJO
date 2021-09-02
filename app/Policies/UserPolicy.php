<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        // dd($model->id,$user->id);
        if($user->rols->contains('slug', 'presidente')) {
            return true;
        } elseif(($user->id) == ($model->id)){
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
        } elseif ($user->permisos->contains('slug', 'crear-usuario')) {
            return true;
        }
        return false;
    }
    /**
     * Undocumented function
     *
     * @param User $user
     * @param Post $post
     * @return void
     */
    public function edit(User $user, User $model)
    {
        if($user->rols->contains('slug', 'presidente')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'actualizar-usuario')) {
            return true;
        }
        return false;
        // if($user->permisos->contains('slug', 'update-usuario')) {
        //     return true;
        // } elseif ($user->rols->contains('slug', 'presidente')) {
        //     return true;
        // }
        // return false;
    }
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        if($user->rols->contains('slug', 'presidente')) {
            return true;
        } elseif ($user->permisos->contains('slug', 'actualizar-usuario')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
