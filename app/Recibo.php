<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    public function ventas(){
        //relacion de * a *
        return $this->belongsToMany(Venta::class, 'ventas_recibos');
    }
}
