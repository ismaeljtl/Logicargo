<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PersonaController extends Controller
{
    public function index(){
        return view("form.persona");
    }

    public function getCiudades(){
        $ciudades = DB::table('Ciudad')->select('id', 'nombre')->orderBy('nombre', 'asc')->get();
        return json_encode($ciudades, true);
    }

    public function create(Request $request){
        $var = $request->all();
        $id = DB::table('Persona')->insertGetId([
            'nombre' => $var['nombre'], 
            'segundo_nombre' => $var['segundo_nombre'],
            'apellido' => $var['apellido'],
            'segundo_apellido' => $var['segundo_apellido'],
            'fecha_Nac' => $var['fecha_Nac'],
            'cedula' => $var['cedula'],
            'Ciudad_id' => $var['ciudades']
        ]);

        DB::table('Ciente')->insert([
            'user' => $var['correo'], 
            'password' => $var['clave'],
            'Persona_id' => $id,
        ]);

        return redirect('/')->with('status', 'Ha sido registrado en el sistema exitosamente!');;
    }

}
