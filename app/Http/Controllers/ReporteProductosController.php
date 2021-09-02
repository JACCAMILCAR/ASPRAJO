<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = DB::select('select p.id as productoid, p.cantidad, p.activo, e.id, e.nombre as especie, v.id, v.nombre as variedad, 
                                c.id, c.nombre as categoria, t.id, t.nombre as tamano, um.id, um.nombre as unidadMedida
                                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um
                                where p.especie_id = e.id
                                and p.variedad_id = v.id
                                and p.categoria_id = c.id
                                and p.tamano_id = t.id
                                and p.unidadMedida_id = um.id
                                and p.activo = true
                                ');
        $inactivos = DB::select('select p.id as productoid, p.cantidad, p.activo, e.id, e.nombre as especie, v.id, v.nombre as variedad, 
                                c.id, c.nombre as categoria, t.id, t.nombre as tamano, um.id, um.nombre as unidadMedida
                                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um
                                where p.especie_id = e.id
                                and p.variedad_id = v.id
                                and p.categoria_id = c.id
                                and p.tamano_id = t.id
                                and p.unidadMedida_id = um.id
                                and p.activo = false
                                ');
        $papas = DB::select('select p.id as productoid, p.cantidad, p.activo, e.id, e.nombre as especie, v.id, v.nombre as variedad, 
                                c.id, c.nombre as categoria, t.id, t.nombre as tamano, um.id, um.nombre as unidadMedida
                                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um
                                where e.nombre LIKE "%PAPA%"
                                and p.especie_id = e.id
                                and p.variedad_id = v.id
                                and p.categoria_id = c.id
                                and p.tamano_id = t.id
                                and p.unidadMedida_id = um.id
                                ');
        $quinuas = DB::select('select p.id as productoid, p.cantidad, p.activo, e.id, e.nombre as especie, v.id, v.nombre as variedad, 
                                c.id, c.nombre as categoria, t.id, t.nombre as tamano, um.id, um.nombre as unidadMedida
                                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um
                                where e.nombre LIKE "%QUINUA%"
                                and p.especie_id = e.id
                                and p.variedad_id = v.id
                                and p.categoria_id = c.id
                                and p.tamano_id = t.id
                                and p.unidadMedida_id = um.id
                                ');
        $bioinsumos = DB::select('select p.id as productoid, p.cantidad, p.activo, e.id, e.nombre as especie, v.id, v.nombre as variedad, 
                                c.id, c.nombre as categoria, t.id, t.nombre as tamano, um.id, um.nombre as unidadMedida
                                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um
                                where e.nombre LIKE "%BIOINSUMO%"
                                and p.especie_id = e.id
                                and p.variedad_id = v.id
                                and p.categoria_id = c.id
                                and p.tamano_id = t.id
                                and p.unidadMedida_id = um.id
                                ');
        return view('reporteProductos.index', compact('productos','inactivos','papas','quinuas','bioinsumos'));
    }

    
}
