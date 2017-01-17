<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PersonaController extends Controller
{
    public function index(){
        $ciudades = DB::table('Ciudad')->select('id', 'nombre')->orderBy('nombre', 'asc')->get();
        return view("form.persona",['ciudades' => $ciudades]);
    }

    public function getCiudades(){
        $ciudades = DB::table('Ciudad')->select('id', 'nombre')->orderBy('nombre', 'asc')->get();
        return json_encode($ciudades, true);
    }

    public function create(Request $request){
        $var = $request->all();
        $id = DB::table('Persona')->insertGetId([
            'user' => $var['correo'], 
            'password' => Hash::make($var['clave']),
            'nombre' => $var['nombre'], 
            'segundo_nombre' => $var['segundo_nombre'],
            'apellido' => $var['apellido'],
            'segundo_apellido' => $var['segundo_apellido'],
            'rol' => 'persona',
            'fecha_Nac' => $var['fecha_Nac'],
            'cedula' => $var['cedula'],
            'Ciudad_id' => $var['ciudades']
        ]);
        Auth::loginUsingId($id,true);
        return redirect('/')->with('status', 'Ha sido registrado en el sistema exitosamente!');
    }

    public function eliminar(){
        $user = Auth::user()->user;
        $id = Auth::id();
        Auth::logout();
        DB::table('Persona')->where('user', '=', $user)->delete();
        if (DB::table('Empleado')->where('Persona_id', '=', $id)->select() != null){
            DB::table('Empleado')->where('Persona_id', '=', $id)->delete();
        }
        return redirect('/')->with('status', 'Ha sido eliminado del sistema exitosamente!');
    }

    //metodo que busca los datos en la BD para mostrarlos en el formulario de actualizacion
    public function actualizar(Request $request){
        $usuario = DB::table('Persona')->where('id', '=', Auth::id())->select()->get();
        $empleado = array();
        if (strcmp($usuario[0]->rol, 'empleado') == 0){
            $empleado = DB::table('Empleado')->where('Persona_id', '=', Auth::id())->select()->get();
        }        
        return view('form.actualizar', array('usuario' => $usuario, 'empleado' => $empleado));
    }

}
