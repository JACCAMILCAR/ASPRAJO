<?php

namespace App\Traits;

use App\Rol;
use App\Permisos;
trait HasRolsPermisos{

    public function isPresidente()
    {
        if($this->rols->contains('slug', 'presidente')){
            return true;
        }
    }

    public function rols(){
        return $this->belongsToMany(Rol::class, 'users_rols');
    }

    public function permisos(){
        return $this->belongsToMany(Permisos::class, 'users_permisos');
    }
    public function productos(){
        //relacion de * a *
        return $this->belongsToMany(Producto::class, 'productos_ventas');
    }
    public function ventas(){
        //relacion de * a *
        return $this->belongsToMany(Ventas::class, 'ventas_recibos');
    }

    public function hasRol($rol){

        if( strpos($rol, ',') !== false ){//check if this is an list of roles

            $listOfRoles = explode(',',$rol);

            foreach ($listOfRoles as $rol) {                    
                if ($this->rols->contains('slug', $rol)) {
                    return true;
                }
            }
        }else{                
            if ($this->rols->contains('slug', $rol)) {
                return true;
            }
        }

        return false;
    }
    public function hasUser($user){

        if( strpos($user, ',') !== false ){//check if this is an list of roles

            $listOfUsers = explode(',',$user);

            foreach ($listOfUsers as $user) {                    
                if ($this->users->contains('slug', $user)) {
                    return true;
                }
            }
        }else{                
            if ($this->users->contains('slug', $user)) {
                return true;
            }
        }

        return false;
    }
}


