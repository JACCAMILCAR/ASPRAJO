<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Especie;
use App\Producto;
use App\Tamano;
use App\UnidadMedida;
use App\Variedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
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
                                ');
        return view('productos.index', compact('productos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Producto::class);
        $especies = Especie::all();
        $variedads = Variedad::all();
        $categorias = Categoria::all();
        $tamanos = Tamano::all();
        $unidadMedidas = UnidadMedida::all();

        return view('productos.create',compact('especies','variedads','categorias','tamanos','unidadMedidas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  
        $request->validate([
            'especie' => 'required',
            'variedad' => 'required',
            'categoria' => 'required',
            'tamano' => 'required',
            'unidadMedida' => 'required',
            'cantidad' => 'required'
        ]);
        $producto = new Producto();
        $producto->especie_id = $request->especie;
        $producto->variedad_id = $request->variedad;
        $producto->categoria_id = $request->categoria;
        $producto->tamano_id = $request->tamano;
        $producto->unidadMedida_id = $request->unidadMedida;
        $producto->cantidad = $request->cantidad;
        $producto->activo = $request->activo;
        $producto->save();
        return redirect('productos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        $this->authorize('view',$producto);
        $id = $producto->id;
        $valor = true;
        $productos = DB::select('select p.id as productoid, p.cantidad, p.especie_id as "idespecie", e.id, e.nombre as "especie", v.id, v.nombre as variedad, 
                                c.id, c.nombre as categoria, t.id, t.nombre as tamano, um.id, um.nombre as unidadMedida
                                from productos p, especies e, variedads v, categorias c, tamanos t, unidad_medidas um
                                where p.especie_id = e.id
                                and p.variedad_id = v.id
                                and p.categoria_id = c.id
                                and p.tamano_id = t.id
                                and p.unidadMedida_id = um.id
                                and p.id ='.$id);
        return view('productos.agregar',compact('productos','id','producto','valor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $this->authorize('edit',$producto);
        $especies = Especie::all();
        $variedads = Variedad::all();
        $categorias = Categoria::all();
        $tamanos = Tamano::all();
        $unidadMedidas = UnidadMedida::all();

        $idespecie = $producto->especie_id;
        $productoEspecie = Especie::findOrFail($idespecie);

        $idvariedad = $producto->variedad_id;
        $productoVariedad = Variedad::findOrFail($idvariedad);
         
        $idcategoria = $producto->categoria_id;
        $productoCategoria = Categoria::findOrFail($idcategoria);

        $idtamano = $producto->tamano_id;
        $productoTamano = Tamano::findOrFail($idtamano);

        $idunidadMedida = $producto->unidadMedida_id;
        $productoUnidadMedida = UnidadMedida::findOrFail($idunidadMedida);

        return view('productos.edit', compact('producto','especies','variedads','categorias','tamanos','unidadMedidas','productoEspecie','productoVariedad','productoCategoria','productoTamano','productoUnidadMedida'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $this->authorize('update',$producto);
        if($request->valor==true){
            $producto->especie_id = $request->especie_id;
            $producto->variedad_id = $request->variedad_id;
            $producto->categoria_id = $request->categoria_id;
            $producto->tamano_id = $request->tamano_id;
            $producto->unidadMedida_id = $request->unidadMedida_id;
            $producto->cantidad = ($producto->cantidad + $request->cantidadAgregada);
            $producto->activo = $request->activo;
            $producto->save();
            return redirect('productos');
        } else{
            $producto->especie_id = $request->especie;
            $producto->variedad_id = $request->variedad;
            $producto->categoria_id = $request->categoria;
            $producto->tamano_id = $request->tamano;
            $producto->unidadMedida_id = $request->unidadMedida;
            $producto->cantidad = $request->cantidad;
            $producto->activo = $request->activo;
            $producto->save();
            return redirect('productos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *s
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $this->authorize('delete',$producto);
        $id = $producto->id;
        $productos = DB::select('select p.id as productoId, v.id as ventaId
                                from ventas v, productos_ventas pv, productos p
                                where p.id ='.$id.'
                                and p.id = pv.producto_id
                                and pv.venta_id = v.id');
        if($productos == null){
            $producto->delete();
            return redirect('/productos');
        }else{
            return redirect('/productos')->with('Mensaje','Error al eliminar el producto, porque esta vinculado a una venta');
        }
                                
        
    }
}
