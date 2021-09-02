<?php

namespace App\Http\Controllers;

use App\Rol;
use App\User;
// use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::orderBy('id','desc')->get();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', User::class);
        if($request->ajax()){
            $rols = Rol::where('id',$request->rol_id)->first();
            $permisos = $rols->permisos;
            return $permisos;
        }
        $rols = Rol::all();

        return view('users.create',['rols' => $rols]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the fields
        $request->validate([
            'name' => 'required|max:255',
            'apellido' => 'required|max:255',
            'ci' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = new User;
        $user->name =$request->name;
        $user->apellido =$request->apellido;
        $user->ci =$request->ci;
        $user->email =$request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if($request->rol != null){
            $user->rols()->attach($request->rol);
            $user->save();
        }

        if ($request->permisos != null) {
            foreach ($request->permisos as $permiso) {
                $user->permisos()->attach($permiso);
                $user->save();
            }
        }

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $this->authorize('view',$user);
        return view('users.show',['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   
        $this->authorize('edit',$user);
        $rols = Rol::get();
        $userRol = $user->rols->first();
        // dd($userRol);
        if($userRol != null){
            $rolPermiso = $userRol->allRolPermisos;
        }else{
            $rolPermiso = null;
        }
        
        $userPermisos = $user->permisos;

        return view('users.edit', compact('rols','userRol', 'rolPermiso','user', 'userPermisos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
       
        $this->authorize('update',$user);
        $request->validate([
            'name' => 'required|max:255',
            'apellido' => 'required|max:255',
            'ci' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'confirmed'
        ]);

        $user->name = $request->name;
        $user->apellido =$request->apellido;
        $user->ci =$request->ci;
        $user->email = $request->email;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->rols()->detach();
        $user->permisos()->detach();

        if($request->rol != null){
            $user->rols()->attach($request->rol);
            $user->save();
        }

        if($request->permisos != null){
            foreach($request->permisos as $permiso){
                $user->permisos()->attach($permiso);
                $user->save();

            }
            
        }

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->rols()->detach();
        $user->permisos()->detach();
        $user->delete();
        return redirect('/users');
    }
}
