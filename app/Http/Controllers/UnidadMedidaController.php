<?php

namespace App\Http\Controllers;

use App\UnidadMedida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnidadMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidadMedidas = UnidadMedida::orderBy('id','desc')->get();
        return view('unidadMedidas.index', compact('unidadMedidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', UnidadMedida::class);
        return view('unidadMedidas.create');
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
            'nombre' => 'required|max:255|unique:unidad_medidas'
        ]);
        $unidadMedida = new UnidadMedida();
        $unidadMedida->nombre = $request->nombre;
        $unidadMedida->save();
        return redirect('unidadMedidas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function show(UnidadMedida $unidadMedida)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function edit(UnidadMedida $unidadMedida)
    {
        $this->authorize('edit',$unidadMedida);
        return view('unidadMedidas.edit', compact('unidadMedida'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnidadMedida $unidadMedida)
    {
        $this->authorize('update',$unidadMedida);
        $request->validate([
            'nombre' => 'required|max:255'
        ]);

        $unidadMedida->nombre = $request->nombre;
        $unidadMedida->save();

        return redirect('unidadMedidas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unidadMedida = UnidadMedida::findOrFail($id);
        $this->authorize('delete',$unidadMedida);

        $unidadMedidas = DB::select('select p.id, p.unidadMedida_id, um.id
                                from productos p, unidad_medidas um
                                where um.id ='.$id.'
                                and um.id = p.unidadMedida_id');
        if($unidadMedidas==null){
            UnidadMedida::destroy($id);
            return redirect('/unidadMedidas');
        }else{
            return redirect('/unidadMedidas')->with('Mensaje','Error al eliminar la Unidad de Medida, porque esta vinculado a un producto');
        }
        
    }
}
