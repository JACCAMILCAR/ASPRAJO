<?php

namespace App\Http\Controllers;

use App\Variedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variedads = Variedad::orderBy('id','desc')->get();
        return view('variedads.index', compact('variedads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Variedad::class);
        return view('variedads.create');
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
            'nombre' => 'required|max:255'
        ]);
        $variedad = new Variedad();
        $variedad->nombre = $request->nombre;
        $variedad->save();
        return redirect('variedads');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Variedad  $variedad
     * @return \Illuminate\Http\Response
     */
    public function show(Variedad $variedad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Variedad  $variedad
     * @return \Illuminate\Http\Response
     */
    public function edit(Variedad $variedad)
    {
        $this->authorize('edit',$variedad);
        return view('variedads.edit', compact('variedad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Variedad  $variedad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variedad $variedad)
    {
        $this->authorize('update',$variedad);
        $request->validate([
            'nombre' => 'required|max:255'
        ]);

        $variedad->nombre = $request->nombre;
        $variedad->save();

        return redirect('variedads');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Variedad  $variedad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $variedad = Variedad::findOrFail($id);
        $this->authorize('delete',$variedad);
 
        $variedads = DB::select('select p.id, p.variedad_id, v.id
                                from productos p, variedads v
                                where v.id ='.$id.'
                                and v.id = p.variedad_id');
        if($variedads==null){
            Variedad::destroy($id);
            return redirect('/variedads');
        }else{
            return redirect('/variedads')->with('Mensaje','Error al eliminar la variedad, porque esta vinculado a un producto');
        }
    }
}
