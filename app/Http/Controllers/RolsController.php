<?php

namespace App\Http\Controllers;

use App\Rol;
use App\Permisos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rols = Rol::orderBy('id','desc')->get();
        return view('rols.index',['rols'=>$rols]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisos = Permisos::all();
        return view('rols.create', compact('permisos'));
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
            'rol_name' => 'required|max:255',
            'rol_slug' => 'required|max:255'
        ]);

        $rol = new Rol();
        $rol->name = $request->rol_name;
        $rol->slug = $request->rol_slug;
        $rol->save();
        
        for($i = 0; $i < count($request->permisos); $i++){
            $rol->permisos()->attach($request->permisos[$i]);
            $rol->save();
        }
        return redirect('/rols');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $rol)
    {
        return view('rols.show',['rol' => $rol]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function edit(Rol $rol)
    {
        $id = $rol->id;
        $permisosSelect = DB::select('select r.id as rolid, p.id as permisosid
                                from permisos p, rols_permisos rp, rols r
                                where r.id ='.$id.'
                                and r.id = rp.rol_id
                                and rp.permisos_id = p.id');
        $permisosAll = Permisos::all();
        return view('rols.edit',compact('rol','permisosSelect','permisosAll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rol $rol)
    {
        $request->validate([
            'rol_name' => 'required|max:255',
            'rol_slug' => 'required|max:255'
        ]);
        $rol->name = $request->rol_name;
        $rol->slug = $request->rol_slug;
        $rol->save();
        $rol->permisos()->detach();
        for($i = 0; $i < count($request->permisos); $i++){
            $rol->permisos()->attach($request->permisos[$i]);
            $rol->save();
        }
        return redirect('/rols');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rol $rol)
    {
        $id = $rol->id;
        $roles = DB::select('select r.id as rolid, u.id as userid
                                from users u, users_rols ur, rols r
                                where r.id ='.$id.'
                                and r.id = ur.rol_id
                                and ur.user_id = u.id');

        $permisos = DB::select('select r.id as rolid, p.id as permisosid
                                from permisos p, rols_permisos rp, rols r
                                where r.id ='.$id.'
                                and r.id = rp.rol_id
                                and rp.permisos_id = p.id');
        if($roles==null){
            for($i = 0; $i < count($permisos); $i++){
                $rol->permisos()->detach($permisos[$i]->permisosid);
            }
            Rol::destroy($id);
            return redirect('/rols');
        }else{
            
            return redirect('/rols')->with('Mensaje','Error al eliminar el rol, porque esta vinculado a un usuario');
        }

        
    }
}
