<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Recibo;
use App\Venta;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Recibo::orderBy('fecha','desc')->get();

        return view('ventas.index',compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Venta::class);
        if($request->ajax()){
            $productos = Producto::where('id',$request->producto_id)->first();
            $cantidad = $productos->cantidad;
            return $cantidad;
        }
        $productos = DB::select('select p.id as productoid, p.cantidad, p.activo, e.id, e.nombre as especie, v.id, v.nombre as variedad, 
                                c.id, c.nombre as categoria, t.id, t.nombre as tamano, um.id, um.nombre as unidadMedida
                                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um
                                where p.especie_id = e.id
                                and p.variedad_id = v.id
                                and p.categoria_id = c.id
                                and p.tamano_id = t.id
                                and p.unidadMedida_id = um.id
                                ');
        return view('ventas.create',compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Venta::class);
        $request->validate([
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
        ]);
        $date = new DateTime();
        $iduser = Auth::user()->id;
        $valor = "ASPRAJO";
        $idRecibo = DB::select('select id from recibos 
                                ORDER BY id desc
                                limit 1');
                                
        if($idRecibo==null){
            $aux = 1;
        }else{
            $aux = $idRecibo[0]->id + 1;
        }
        $total = 0.0;
        $subTotal = 0.0;
        $limite = count($request->id_articulo);

        $recibo = new Recibo;
        $recibo->user_id =$iduser;
        $recibo->ciCliente =$request->ciCliente;
        $recibo->nombres =$request->nombres;
        $recibo->apellidos =$request->apellidos;
        $recibo->celularCliente =$request->celularCliente;
        $recibo->aCuenta =$request->aCuenta;
        
        
        for($i=0 ; $i < $limite; $i++){
            $ventas = new Venta;
            $ventas->cantidad = $request->cantidad[$i];
            $ventas->descripcion = $request->descripcion[$i];
            $ventas->precioUnitario = $request->precio_venta[$i];
            $subTotal = $request->cantidad[$i] * $request->precio_venta[$i];
            $total = $subTotal + $total;
            $ventas->save();
            $ventas->productos()->attach($request->id_articulo[$i]);
            $ventas->save();
            
            DB::update('update productos set cantidad = (cantidad - '.$request->cantidad[$i].') 
                        where id = '.$request->id_articulo[$i]);
        }

        $recibo->saldo = $total - $recibo->aCuenta;
        $recibo->lugar =$request->lugar;
        $recibo->fecha = $date->format('Y-m-d');
        $recibo->codigoControl = str_replace('A', $aux, $valor);
        $recibo->save();

        $idVentas = DB::select('select id from ventas 
                                ORDER BY id desc
                                limit '.$limite);
        // $listaV = explode($idVentas);
        for($i= $limite-1 ; $i >=0 ; $i--){
            $recibo->ventas()->attach($idVentas[$i]);
            $recibo->save();
        }


        return redirect('/ventas');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        $this->authorize('view',$venta);
        $id = $venta->id;
        $ventas = DB::select('select r.id as idRecibo, r.fecha, r.ciCliente, p.id as productoid, p.cantidad, p.activo as estado, e.id, e.nombre as especie, 
        v.id, v.nombre as variedad, c.id, c.nombre as categoria, t.id, t.nombre as tamano, um.id, um.nombre as unidadMedida, 
        ve.id as idVenta, r.nombres, r.apellidos, r.codigoControl, r.celularCliente, r.lugar, r.aCuenta, r.saldo,
        ve.cantidad, ve.descripcion, ve.precioUnitario
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
        and r.id = '.$id);
        return view('ventas.recibo',compact('ventas','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta, Request $request)
    {
        $this->authorize('view',$venta);
        $id = $venta->id;
        $ventas = DB::select('select r.id as idRecibo, r.fecha, r.ciCliente, p.id as productoid, p.cantidad, p.activo as estado, e.id, e.nombre as especie, 
        v.id, v.nombre as variedad, c.id, c.nombre as categoria, t.id, t.nombre as tamano, um.id, um.nombre as unidadMedida, 
        ve.id as idVenta, r.nombres, r.apellidos, r.codigoControl, r.celularCliente, r.lugar, r.aCuenta, r.saldo,
        ve.cantidad, ve.descripcion, ve.precioUnitario
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
        and r.id = '.$id);

        if($request->ajax()){
            $productos = Producto::where('id',$request->producto_id)->first();
            $cantidad = $productos->cantidad;
            return $cantidad;
        }
        $productos = DB::select('select p.id as productoid, p.cantidad, p.activo, e.id, e.nombre as especie, v.id, v.nombre as variedad, 
                                c.id, c.nombre as categoria, t.id, t.nombre as tamano, um.id, um.nombre as unidadMedida
                                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um
                                where p.especie_id = e.id
                                and p.variedad_id = v.id
                                and p.categoria_id = c.id
                                and p.tamano_id = t.id
                                and p.unidadMedida_id = um.id
                                ');
        // dd($ventas);
        return view('ventas.edit',compact('ventas','id','productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {

        $request->validate([
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
        ]);
        $idRecibo = $request->reciboasprajo;
        $iduser = Auth::user()->id;
             
        
        $total = 0.0;
        $subTotal = 0.0;
        $auxiliar=0.0;
        $limiteNuevaVenta=0;
        $igualar = [];
        $limite = count($request->id_articulo);
        $cantidadVendida = 0.0;
        $existeDato = DB::select('select v.id as idVenta, v.cantidad as cantidadVenta
                                from recibos r, ventas_recibos vr, ventas v, productos_ventas pv, productos p
                                where r.id = '.$idRecibo.'
                                and r.id = vr.recibo_id
                                and vr.venta_id = v.id
                                and v.id = pv.venta_id
                                and pv.producto_id = p.id
                                '
                            );

        for($i=0 ; $i < $limite; $i++){

            $existeVenta = DB::select('select v.id as idVenta, v.cantidad as cantidadVenta
                                from recibos r, ventas_recibos vr, ventas v, productos_ventas pv, productos p
                                where r.id = '.$idRecibo.'
                                and r.id = vr.recibo_id
                                and vr.venta_id = v.id
                                and v.id = pv.venta_id
                                and pv.producto_id = p.id
                                and p.id = '.$request->id_articulo[$i]
                            );
            $cantidadProducto = DB::select('select cantidad
                                    from productos
                                    where id = '.$request->id_articulo[$i]
                                );
            $cantidadVendida = $request->cantidad[$i];
            if($existeVenta==null){
                if($cantidadVendida > ($cantidadProducto[0]->cantidad)){
                    $cantidadVendida = ($cantidadProducto[0]->cantidad);
                }
                $ventas = new Venta;
                $ventas->cantidad = $cantidadVendida;
                $ventas->descripcion = $request->descripcion[$i];
                $ventas->precioUnitario = $request->precio_venta[$i];
                $subTotal = $cantidadVendida * $request->precio_venta[$i];
                $total = $subTotal + $total;
                $ventas->save();
                $ventas->productos()->attach($request->id_articulo[$i]);
                $ventas->save();
                
                DB::update('update productos set cantidad = (cantidad - '.$cantidadVendida.') 
                            where id = '.$request->id_articulo[$i]);
                $limiteNuevaVenta++;
            }else {
                for($x=0; $x < count($existeDato);$x++){
                    if($existeVenta[0]->idVenta==$existeDato[$x]->idVenta){
                        $igualar[$x]=1;
                    }
                }
                if($cantidadVendida > ($cantidadProducto[0]->cantidad + $existeVenta[0]->cantidadVenta)){
                    $cantidadVendida = ($cantidadProducto[0]->cantidad + $existeVenta[0]->cantidadVenta);
                }
                DB::update('update ventas 
                                set cantidad = '.$cantidadVendida.',
                                descripcion = "'.$request->descripcion[$i].'",
                                precioUnitario = '.$request->precio_venta[$i].'
                                where id = '.$existeVenta[0]->idVenta
                );
                $subTotal = $cantidadVendida * $request->precio_venta[$i];
                $total = $subTotal + $total;

                if($cantidadVendida >= $existeVenta[0]->cantidadVenta){
                    $auxiliar = ($cantidadVendida - $existeVenta[0]->cantidadVenta);
                    DB::update('update productos set cantidad = (cantidad - '.$auxiliar.') 
                        where id = '.$request->id_articulo[$i]);
                }else{
                    $auxiliar = ($existeVenta[0]->cantidadVenta - $cantidadVendida);
                    DB::update('update productos set cantidad = (cantidad + '.$auxiliar.') 
                        where id = '.$request->id_articulo[$i]);
                }
                                
                
            }

        }
        $idVentas = DB::select('select id from ventas 
                                ORDER BY id desc
                                limit '.$limiteNuevaVenta);

        $recibo = Recibo::findOrFail($idRecibo);
        if($limiteNuevaVenta>0){
            for($i= $limiteNuevaVenta-1 ; $i >=0 ; $i--){
                $recibo->ventas()->attach($idVentas[$i]);
                $recibo->save();    
            }
        }
        
       
        for($y=0; $y < count($existeDato); $y++){
            if(empty($igualar[$y])){
                $idProducto = DB::select('select p.id as productoId
                                    from productos p, productos_ventas pv, ventas v
                                    where v.id = '.$existeDato[$y]->idVenta.'
                                    and v.id = pv.venta_id
                                    and pv.producto_id = p.id
                                    ');
                $producto = $idProducto[0]->productoId;
                Venta::destroy($existeDato[$y]->idVenta);
                DB::update('update productos set cantidad = ( cantidad + '.$existeDato[$y]->cantidadVenta.' ) 
                            where id = '.$producto);
            }
        }
        DB::update('update recibos 
                    set user_id = '.$iduser.',
                    ciCliente = "'.$request->ciCliente.'",
                    nombres = "'.$request->nombres.'",
                    apellidos = "'.$request->apellidos.'",
                    celularCliente = "'.$request->celularCliente.'",
                    aCuenta = '.$request->aCuenta.',
                    lugar = "'.$request->lugar.'"
                    where id = '.$idRecibo
        );

        
        return redirect('/ventas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        $this->authorize('delete',$venta);
        $id = $venta->id;
        $listaVentas = DB::select('select v.id as ventaId, v.cantidad
                                    from recibos r, ventas_recibos vr, ventas v
                                    where r.id ='.$id.'
                                    and r.id = vr.recibo_id
                                    and vr.venta_id = v.id
                                    ');
        Recibo::destroy($id);
        for($i = 0; $i < count($listaVentas); $i++){
            $idProducto = DB::select('select p.id as productoId
                                    from productos p, productos_ventas pv, ventas v
                                    where v.id = '.$listaVentas[$i]->ventaId.'
                                    and v.id = pv.venta_id
                                    and pv.producto_id = p.id
                                    ');
            $producto = $idProducto[0]->productoId;
            Venta::destroy($listaVentas[$i]->ventaId);
            DB::update('update productos set cantidad = ( cantidad + '.$listaVentas[$i]->cantidad.' ) 
                        where id = '.$producto);
        }
        return redirect('/ventas');

    }
}
