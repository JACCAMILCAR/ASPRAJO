<?php

namespace App\Http\Controllers;

use App\Especie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $especies = Especie::orderBy('id','desc')->get();
        return view('especies.index', compact('especies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Especie::class);
        return view('especies.create');
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
        $especie = new Especie();
        $especie->nombre = $request->nombre;
        $especie->save();
        return redirect('especies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function show(Especie $especie)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function edit(Especie $especy)
    {
        $this->authorize('edit',$especy);
                return view('especies.edit', ['especie' => $especy]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Especie $especy)
    {
        $this->authorize('update',$especy);
        $request->validate([
            'nombre' => 'required|max:255'
        ]);

        $especy->nombre = $request->nombre;
        $especy->save();

        return redirect('especies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especy = Especie::findOrFail($id);
        $this->authorize('delete',$especy);

        $especies = DB::select('select p.id, p.especie_id, e.id
                                from productos p, especies e
                                where e.id ='.$id.'
                                and e.id = p.especie_id');
        if($especies==null){
            Especie::destroy($id);
            return redirect('/especies');
        }else{
            return redirect('/especies')->with('Mensaje','Error al eliminar la especie, porque esta vinculado a un producto');
        }
        
    }
}
