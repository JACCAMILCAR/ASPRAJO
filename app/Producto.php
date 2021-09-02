<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public function ventas(){
        //relacion de * a *
        return $this->belongsToMany(Venta::class, 'productos_ventas');
    }

}
