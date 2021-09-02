<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteVentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = DB::select('select Mes, Cantidad, Precio from (
                                select "Enero" as Mes, SUM( ve.cantidad) as "Cantidad", SUM( ve.precioUnitario * ve.cantidad) as "Precio"
                                    from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                                    recibos r, ventas_recibos vr
                                    where p.especie_id = e.id
                                    and p.variedad_id = v.id
                                    and p.categoria_id = c.id
                                    and p.tamano_id = t.id
                                    and p.unidadMedida_id = um.id
                                    and p.id = pv.producto_id
                                    and pv.venta_id = ve.id
                                    and ve.id = vr.venta_id
                                    and vr.recibo_id = r.id
                                    and MONTH (r.fecha) = 10 
                                UNION select "Febrero" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                                    from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                                    recibos r, ventas_recibos vr
                                    where p.especie_id = e.id
                                    and p.variedad_id = v.id
                                    and p.categoria_id = c.id
                                    and p.tamano_id = t.id
                                    and p.unidadMedida_id = um.id
                                    and p.id = pv.producto_id
                                    and pv.venta_id = ve.id
                                    and ve.id = vr.venta_id
                                    and vr.recibo_id = r.id
                                    and MONTH (r.fecha) = 2 
                                UNION select "Marzo" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                                    from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                                    recibos r, ventas_recibos vr
                                    where p.especie_id = e.id
                                    and p.variedad_id = v.id
                                    and p.categoria_id = c.id
                                    and p.tamano_id = t.id
                                    and p.unidadMedida_id = um.id
                                    and p.id = pv.producto_id
                                    and pv.venta_id = ve.id
                                    and ve.id = vr.venta_id
                                    and vr.recibo_id = r.id
                                    and MONTH (r.fecha) = 3
                                UNION select "Abril" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                                    from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                                    recibos r, ventas_recibos vr
                                    where p.especie_id = e.id
                                    and p.variedad_id = v.id
                                    and p.categoria_id = c.id
                                    and p.tamano_id = t.id
                                    and p.unidadMedida_id = um.id
                                    and p.id = pv.producto_id
                                    and pv.venta_id = ve.id
                                    and ve.id = vr.venta_id
                                    and vr.recibo_id = r.id
                                    and MONTH (r.fecha) = 4
                                UNION select "Mayo" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                                    from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                                    recibos r, ventas_recibos vr
                                    where p.especie_id = e.id
                                    and p.variedad_id = v.id
                                    and p.categoria_id = c.id
                                    and p.tamano_id = t.id
                                    and p.unidadMedida_id = um.id
                                    and p.id = pv.producto_id
                                    and pv.venta_id = ve.id
                                    and ve.id = vr.venta_id
                                    and vr.recibo_id = r.id
                                    and MONTH (r.fecha) = 5
                                UNION select "Junio" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                                    from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                                    recibos r, ventas_recibos vr
                                    where p.especie_id = e.id
                                    and p.variedad_id = v.id
                                    and p.categoria_id = c.id
                                    and p.tamano_id = t.id
                                    and p.unidadMedida_id = um.id
                                    and p.id = pv.producto_id
                                    and pv.venta_id = ve.id
                                    and ve.id = vr.venta_id
                                    and vr.recibo_id = r.id
                                    and MONTH (r.fecha) = 6
                                UNION select "Julio" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                                    from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                                    recibos r, ventas_recibos vr
                                    where p.especie_id = e.id
                                    and p.variedad_id = v.id
                                    and p.categoria_id = c.id
                                    and p.tamano_id = t.id
                                    and p.unidadMedida_id = um.id
                                    and p.id = pv.producto_id
                                    and pv.venta_id = ve.id
                                    and ve.id = vr.venta_id
                                    and vr.recibo_id = r.id
                                    and MONTH (r.fecha) = 7
                                UNION select "Agosto" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                                    from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                                    recibos r, ventas_recibos vr
                                    where p.especie_id = e.id
                                    and p.variedad_id = v.id
                                    and p.categoria_id = c.id
                                    and p.tamano_id = t.id
                                    and p.unidadMedida_id = um.id
                                    and p.id = pv.producto_id
                                    and pv.venta_id = ve.id
                                    and ve.id = vr.venta_id
                                    and vr.recibo_id = r.id
                                    and MONTH (r.fecha) = 8
                                UNION select "Septiembre" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                                    from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                                    recibos r, ventas_recibos vr
                                    where p.especie_id = e.id
                                    and p.variedad_id = v.id
                                    and p.categoria_id = c.id
                                    and p.tamano_id = t.id
                                    and p.unidadMedida_id = um.id
                                    and p.id = pv.producto_id
                                    and pv.venta_id = ve.id
                                    and ve.id = vr.venta_id
                                    and vr.recibo_id = r.id
                                    and MONTH (r.fecha) = 9
                                UNION select "Octubre" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                                    from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                                    recibos r, ventas_recibos vr
                                    where p.especie_id = e.id
                                    and p.variedad_id = v.id
                                    and p.categoria_id = c.id
                                    and p.tamano_id = t.id
                                    and p.unidadMedida_id = um.id
                                    and p.id = pv.producto_id
                                    and pv.venta_id = ve.id
                                    and ve.id = vr.venta_id
                                    and vr.recibo_id = r.id
                                    and MONTH (r.fecha) = 10
                                UNION select "Noviembre" as Mes, SUM( ve.cantidad) as "Cantidad", SUM( ve.precioUnitario * ve.cantidad ) as "Precio"
                                    from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                                    recibos r, ventas_recibos vr
                                    where p.especie_id = e.id
                                    and p.variedad_id = v.id
                                    and p.categoria_id = c.id
                                    and p.tamano_id = t.id
                                    and p.unidadMedida_id = um.id
                                    and p.id = pv.producto_id
                                    and pv.venta_id = ve.id
                                    and ve.id = vr.venta_id
                                    and vr.recibo_id = r.id
                                    and MONTH (r.fecha) = 11 
                                UNION select "Diciembre" as Mes, SUM(ve.cantidad ) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                                    from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                                    recibos r, ventas_recibos vr
                                    where p.especie_id = e.id
                                    and p.variedad_id = v.id
                                    and p.categoria_id = c.id
                                    and p.tamano_id = t.id
                                    and p.unidadMedida_id = um.id
                                    and p.id = pv.producto_id
                                    and pv.venta_id = ve.id
                                    and ve.id = vr.venta_id
                                    and vr.recibo_id = r.id
                                    and MONTH (r.fecha) = 12
                            ) d'
        );
                $papas = DB::select('select Mes, Cantidad, Precio from (
                    select "Enero" as Mes, SUM( ve.cantidad) as "Cantidad", SUM( ve.precioUnitario * ve.cantidad) as "Precio"
                        from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                        recibos r, ventas_recibos vr
                        where e.nombre LIKE "%PAPA%"
                        and p.especie_id = e.id
                        and p.variedad_id = v.id
                        and p.categoria_id = c.id
                        and p.tamano_id = t.id
                        and p.unidadMedida_id = um.id
                        and p.id = pv.producto_id
                        and pv.venta_id = ve.id
                        and ve.id = vr.venta_id
                        and vr.recibo_id = r.id
                        and MONTH (r.fecha) = 10 
                    UNION select "Febrero" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                        from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                        recibos r, ventas_recibos vr
                        where e.nombre LIKE "%PAPA%"
                        and p.especie_id = e.id
                        and p.variedad_id = v.id
                        and p.categoria_id = c.id
                        and p.tamano_id = t.id
                        and p.unidadMedida_id = um.id
                        and p.id = pv.producto_id
                        and pv.venta_id = ve.id
                        and ve.id = vr.venta_id
                        and vr.recibo_id = r.id
                        and MONTH (r.fecha) = 2 
                    UNION select "Marzo" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                        from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                        recibos r, ventas_recibos vr
                        where e.nombre LIKE "%PAPA%"
                        and p.especie_id = e.id
                        and p.variedad_id = v.id
                        and p.categoria_id = c.id
                        and p.tamano_id = t.id
                        and p.unidadMedida_id = um.id
                        and p.id = pv.producto_id
                        and pv.venta_id = ve.id
                        and ve.id = vr.venta_id
                        and vr.recibo_id = r.id
                        and MONTH (r.fecha) = 3
                    UNION select "Abril" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                        from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                        recibos r, ventas_recibos vr
                        where e.nombre LIKE "%PAPA%"
                        and p.especie_id = e.id
                        and p.variedad_id = v.id
                        and p.categoria_id = c.id
                        and p.tamano_id = t.id
                        and p.unidadMedida_id = um.id
                        and p.id = pv.producto_id
                        and pv.venta_id = ve.id
                        and ve.id = vr.venta_id
                        and vr.recibo_id = r.id
                        and MONTH (r.fecha) = 4
                    UNION select "Mayo" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                        from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                        recibos r, ventas_recibos vr
                        where e.nombre LIKE "%PAPA%"
                        and p.especie_id = e.id
                        and p.variedad_id = v.id
                        and p.categoria_id = c.id
                        and p.tamano_id = t.id
                        and p.unidadMedida_id = um.id
                        and p.id = pv.producto_id
                        and pv.venta_id = ve.id
                        and ve.id = vr.venta_id
                        and vr.recibo_id = r.id
                        and MONTH (r.fecha) = 5
                    UNION select "Junio" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                        from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                        recibos r, ventas_recibos vr
                        where e.nombre LIKE "%PAPA%"
                        and p.especie_id = e.id
                        and p.variedad_id = v.id
                        and p.categoria_id = c.id
                        and p.tamano_id = t.id
                        and p.unidadMedida_id = um.id
                        and p.id = pv.producto_id
                        and pv.venta_id = ve.id
                        and ve.id = vr.venta_id
                        and vr.recibo_id = r.id
                        and MONTH (r.fecha) = 6
                    UNION select "Julio" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                        from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                        recibos r, ventas_recibos vr
                        where e.nombre LIKE "%PAPA%"
                        and p.especie_id = e.id
                        and p.variedad_id = v.id
                        and p.categoria_id = c.id
                        and p.tamano_id = t.id
                        and p.unidadMedida_id = um.id
                        and p.id = pv.producto_id
                        and pv.venta_id = ve.id
                        and ve.id = vr.venta_id
                        and vr.recibo_id = r.id
                        and MONTH (r.fecha) = 7
                    UNION select "Agosto" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                        from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                        recibos r, ventas_recibos vr
                        where e.nombre LIKE "%PAPA%"
                        and p.especie_id = e.id
                        and p.variedad_id = v.id
                        and p.categoria_id = c.id
                        and p.tamano_id = t.id
                        and p.unidadMedida_id = um.id
                        and p.id = pv.producto_id
                        and pv.venta_id = ve.id
                        and ve.id = vr.venta_id
                        and vr.recibo_id = r.id
                        and MONTH (r.fecha) = 8
                    UNION select "Septiembre" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                        from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                        recibos r, ventas_recibos vr
                        where e.nombre LIKE "%PAPA%"
                        and p.especie_id = e.id
                        and p.variedad_id = v.id
                        and p.categoria_id = c.id
                        and p.tamano_id = t.id
                        and p.unidadMedida_id = um.id
                        and p.id = pv.producto_id
                        and pv.venta_id = ve.id
                        and ve.id = vr.venta_id
                        and vr.recibo_id = r.id
                        and MONTH (r.fecha) = 9
                    UNION select "Octubre" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                        from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                        recibos r, ventas_recibos vr
                        where e.nombre LIKE "%PAPA%"
                        and p.especie_id = e.id
                        and p.variedad_id = v.id
                        and p.categoria_id = c.id
                        and p.tamano_id = t.id
                        and p.unidadMedida_id = um.id
                        and p.id = pv.producto_id
                        and pv.venta_id = ve.id
                        and ve.id = vr.venta_id
                        and vr.recibo_id = r.id
                        and MONTH (r.fecha) = 10
                    UNION select "Noviembre" as Mes, SUM( ve.cantidad) as "Cantidad", SUM( ve.precioUnitario * ve.cantidad) as "Precio"
                        from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                        recibos r, ventas_recibos vr
                        where e.nombre LIKE "%PAPA%"
                        and p.especie_id = e.id
                        and p.variedad_id = v.id
                        and p.categoria_id = c.id
                        and p.tamano_id = t.id
                        and p.unidadMedida_id = um.id
                        and p.id = pv.producto_id
                        and pv.venta_id = ve.id
                        and ve.id = vr.venta_id
                        and vr.recibo_id = r.id
                        and MONTH (r.fecha) = 11 
                    UNION select "Diciembre" as Mes, SUM(ve.cantidad ) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                        from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                        recibos r, ventas_recibos vr
                        where e.nombre LIKE "%PAPA%"
                        and p.especie_id = e.id
                        and p.variedad_id = v.id
                        and p.categoria_id = c.id
                        and p.tamano_id = t.id
                        and p.unidadMedida_id = um.id
                        and p.id = pv.producto_id
                        and pv.venta_id = ve.id
                        and ve.id = vr.venta_id
                        and vr.recibo_id = r.id
                        and MONTH (r.fecha) = 12
                ) d'
        );
        $quinuas = DB::select('select Mes, Cantidad, Precio from (
            select "Enero" as Mes, SUM( ve.cantidad) as "Cantidad", SUM( ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%QUINUA%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 10 
            UNION select "Febrero" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%QUINUA%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 2 
            UNION select "Marzo" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%QUINUA%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 3
            UNION select "Abril" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%QUINUA%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 4
            UNION select "Mayo" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%QUINUA%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 5
            UNION select "Junio" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%QUINUA%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 6
            UNION select "Julio" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%QUINUA%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 7
            UNION select "Agosto" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%QUINUA%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 8
            UNION select "Septiembre" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%QUINUA%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 9
            UNION select "Octubre" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%QUINUA%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 10
            UNION select "Noviembre" as Mes, SUM( ve.cantidad) as "Cantidad", SUM( ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%QUINUA%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 11 
            UNION select "Diciembre" as Mes, SUM(ve.cantidad ) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%QUINUA%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 12
        ) d'
        );
        $bioinsumos = DB::select('select Mes, Cantidad, Precio from (
            select "Enero" as Mes, SUM( ve.cantidad) as "Cantidad", SUM( ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%BIOINSUMO%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 10 
            UNION select "Febrero" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%BIOINSUMO%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 2 
            UNION select "Marzo" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%BIOINSUMO%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 3
            UNION select "Abril" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%BIOINSUMO%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 4
            UNION select "Mayo" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%BIOINSUMO%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 5
            UNION select "Junio" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%BIOINSUMO%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 6
            UNION select "Julio" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%BIOINSUMO%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 7
            UNION select "Agosto" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%BIOINSUMO%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 8
            UNION select "Septiembre" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%BIOINSUMO%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 9
            UNION select "Octubre" as Mes, SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%BIOINSUMO%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 10
            UNION select "Noviembre" as Mes, SUM( ve.cantidad) as "Cantidad", SUM( ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%BIOINSUMO%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 11 
            UNION select "Diciembre" as Mes, SUM(ve.cantidad ) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where e.nombre LIKE "%BIOINSUMO%"
                and p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 12
        ) d'
        );
        $ventaProductos = DB::select('select Mes, Producto, Cantidad, Precio from (
            select "Enero" as Mes, v.nombre as "Producto", SUM( ve.cantidad) as "Cantidad", SUM( ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 1
                GROUP BY v.nombre 
            UNION select "Febrero" as Mes, v.nombre as "Producto", SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 2
                GROUP BY v.nombre 
            UNION select "Marzo" as Mes, v.nombre as "Producto", SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 3
                GROUP BY v.nombre
            UNION select "Abril" as Mes, v.nombre as "Producto", SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 4
                GROUP BY v.nombre
            UNION select "Mayo" as Mes, v.nombre as "Producto", SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 5
                GROUP BY v.nombre
            UNION select "Junio" as Mes, v.nombre as "Producto", SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 6
                GROUP BY v.nombre
            UNION select "Julio" as Mes, v.nombre as "Producto", SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 7
                GROUP BY v.nombre
            UNION select "Agosto" as Mes, v.nombre as "Producto", SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 8
                GROUP BY v.nombre
            UNION select "Septiembre" as Mes, v.nombre as "Producto", SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 9
                GROUP BY v.nombre
            UNION select "Octubre" as Mes, v.nombre as "Producto", SUM(ve.cantidad) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 10
                GROUP BY v.nombre
            UNION select "Noviembre" as Mes, v.nombre as "Producto", SUM( ve.cantidad) as "Cantidad", SUM( ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 11
                GROUP BY v.nombre
            UNION select "Diciembre" as Mes, v.nombre as "Producto", SUM(ve.cantidad ) as "Cantidad", SUM(ve.precioUnitario * ve.cantidad) as "Precio"
                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um, ventas ve, productos_ventas pv, 
                recibos r, ventas_recibos vr
                where p.especie_id = e.id
                and p.variedad_id = v.id
                and p.categoria_id = c.id
                and p.tamano_id = t.id
                and p.unidadMedida_id = um.id
                and p.id = pv.producto_id
                and pv.venta_id = ve.id
                and ve.id = vr.venta_id
                and vr.recibo_id = r.id
                and MONTH (r.fecha) = 12
                GROUP BY v.nombre
        ) d'
        );
        // dd($ventaProductos);
        return view('reporteVentas.index',compact('ventas','papas','quinuas','bioinsumos','ventaProductos'));
    }

  
}
