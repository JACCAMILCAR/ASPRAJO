<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public function productos(){
        //relacion de * a *
        return $this->belongsToMany(Producto::class, 'productos_ventas');
    }
}
