<?php

namespace App\Http\Controllers;

use App\Permisos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermisosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permisos::orderBy('id','desc')->get();
        return view('permisos.index', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Permisos::class);
        return view('permisos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Permisos::class);
        $request->validate([
            'permiso_name' => 'required|max:255',
            'permiso_slug' => 'required|max:255'
        ]);
        $permiso = new Permisos();
        $permiso->name = $request->permiso_name;
        $permiso->slug = strtolower(str_replace(" ",'-', $request->permiso_slug));
        $permiso->save();
        return redirect('/permisos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permisos  $permisos
     * @return \Illuminate\Http\Response
     */
    public function edit(Permisos $permiso)
    {
        $this->authorize('update',$permiso);
        return view('permisos.edit',compact('permiso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permisos  $permisos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permisos  $permiso)
    {
        $this->authorize('update',$permiso);
        $request->validate([
            'permiso_name' => 'required|max:255',
            'permiso_slug' => 'required|max:255'
        ]);
        $permiso->name = $request->permiso_name;
        $permiso->slug = strtolower(str_replace(" ",'-', $request->permiso_slug));
        $permiso->save();

        return redirect('/permisos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permisos  $permiso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permisos $permiso)
    {
        $this->authorize('delete',$permiso);
        $id = $permiso->id;
        $permisos = DB::select('select r.id as rolid, p.id as permisosid
                                from permisos p, rols_permisos rp, rols r
                                where p.id ='.$id.'
                                and p.id = rp.permisos_id
                                and rp.rol_id = r.id');
        if($permisos == null){
            Permisos::destroy($id);
            return redirect('/permisos');
        }else{
            
            return redirect('/permisos')->with('Mensaje','Error al eliminar el permiso, porque esta vinculado a un Rol');
        }
    }
}
