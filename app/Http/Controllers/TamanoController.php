<?php

namespace App\Http\Controllers;

use App\Tamano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TamanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tamanos = Tamano::orderBy('id','desc')->get();
        return view('tamanos.index', compact('tamanos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Tamano::class);
        return view('tamanos.create');
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
            'nombre' => 'required|max:255|unique:tamanos',
            'medidaMinima' => 'required|max:255',
            'medidaMaxima' => 'required|max:255'
        ]);
        $tamano = new Tamano();
        $tamano->nombre = $request->nombre;
        $tamano->medidaMinima = $request->medidaMinima;
        $tamano->medidaMaxima = $request->medidaMaxima;
        $tamano->save();
        return redirect('tamanos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tamano  $tamano
     * @return \Illuminate\Http\Response
     */
    public function show(Tamano $tamano)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tamano  $tamano
     * @return \Illuminate\Http\Response
     */
    public function edit(Tamano $tamano)
    {
        $this->authorize('edit',$tamano);
        return view('tamanos.edit', compact('tamano'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tamano  $tamano
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tamano $tamano)
    {
        $this->authorize('update',$tamano);
        $request->validate([
            'nombre' => 'required|max:255',
            'medidaMinima' => 'required|max:255',
            'medidaMaxima' => 'required|max:255'
        ]);

        $tamano->nombre = $request->nombre;
        $tamano->medidaMinima = $request->medidaMinima;
        $tamano->medidaMaxima = $request->medidaMaxima;
        $tamano->save();

        return redirect('tamanos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tamano  $tamano
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tamano = Tamano::findOrFail($id);
        $this->authorize('delete',$tamano);
        
        $tamanos = DB::select('select p.id, p.tamano_id, t.id
        from productos p, tamanos t
        where t.id ='.$id.'
        and t.id = p.tamano_id');
        if($tamanos==null){
            Tamano::destroy($id);
            return redirect('/tamanos');
        }else{
        return redirect('/tamanos')->with('Mensaje','Error al eliminar el tamaño, porque esta vinculado a un producto');
        }
    }
}
