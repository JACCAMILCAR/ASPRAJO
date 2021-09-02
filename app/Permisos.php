<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    //relacion de * a *
    public function rols(){
        return $this->belongsToMany(Rol::class, 'rols_permisos');
    }
}
