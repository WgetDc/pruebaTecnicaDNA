<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new Usuario();
        $user->nombre = $request->txtNombre;
        $user->apellido = $request->txtApellido;
        $user->email = $request->txtEmail;
        $user->direccion = $request->txtDireccion;
        $user->rut = $request->rut;
        $user->perfil = rand(1,10000);
        $user->estado = $request->inputGroupEstado;
        $user->save();
        return redirect('/home');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = Usuario::find($id);
        return view('usuarios.editar_usuario', [
            'usuario' => $usuario
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Usuario::find($id);
        $user->nombre = $request->txtNombre;
        $user->apellido = $request->txtApellido;
        $user->email = $request->txtEmail;
        $user->direccion = $request->txtDireccion;
        $user->rut = $request->rut;
        $user->perfil = rand(1,10000);
        $user->estado = $request->inputGroupEstado;
        $user->save();
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Usuario::find($id);
        $user->delete();
        return redirect('/home');
    }

    public function confirmDelete($id)
    {
        $usuario = Usuario::find($id);
        return view('usuarios.eliminar_usuario', [
            'usuario' => $usuario
        ]);
    }
}
