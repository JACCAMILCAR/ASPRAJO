<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    public function permisos(){
        //relacion de * a *
        return $this->belongsToMany(Permisos::class, 'rols_permisos');
    }

    public function allRolPermisos(){
        return $this->belongsToMany(Permisos::class, 'rols_permisos');
    }
}
