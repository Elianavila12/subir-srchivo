<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use App\Imports\UsuarioImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('/usuario/index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/usuario/crear');
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
            'cedula'=>'required|max:100.|unique:users,cedula',
            'nombre'=>'required',
            'peso'=>'required',
            'fecha_nacimiento'=>'required',
            'fecha_hora_ingreso'=>'required',
        ]);
        
        $usuario = new User();
        $usuario->cedula = $request->cedula;
        $usuario->nombre = $request->nombre;
        $usuario->peso = $request->peso;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->fecha_hora_ingreso = $request->fecha_hora_ingreso;

        if (isset($request->estado)) {
            $usuario->estado = $request->estado;
        } else {
            $usuario->estado = 1;
        }

        $usuario->save();

        return back()->with('mensaje', 'Usuario registrado exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('/usuario/editar',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'cedula'=>'required|max:100|unique:users,cedula',
            'nombre'=>'required',
            'peso'=>'required',
            'fecha_nacimiento'=>'required',
            'fecha_hora_ingreso'=>'required',
        ]);

        $user->cedula = $request->cedula;
        $user->nombre = $request->nombre;
        $user->peso = $request->peso;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->fecha_hora_ingreso = $request->fecha_hora_ingreso;
        $user->estado = $request->estado;
        $user->save();

        return back()->with('mensaje', 'Usuario actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('mensaje', 'Usuario eliminado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportCSV()
    { 
        $user = User::all();
        $array = $user->toArray();
        return Excel::download(new UserExport($array), 'usuarios.csv');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function importCSV(Request $request)
    { 
        $usuarios = array();
        $errores = array();
        
        if ($request->hasFile('archivo')) {
            $importar = new UsuarioImport($request->row);
            $importar->import($request->file('archivo'), null, \Maatwebsite\Excel\Excel::CSV);
            $errores = $importar->getErrors();
            $usuarios = $importar->getNewRegisters();
        }

        return view('/usuario/archivo',compact('usuarios', 'errores'));
    }
}
