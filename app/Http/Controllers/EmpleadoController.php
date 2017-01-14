<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmpleadoController extends Controller
{
    public function index(){
        return view("form.empleado");
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
            'rol' => 'empleado',
            'fecha_Nac' => $var['fecha_Nac'],
            'cedula' => $var['cedula'],
            'Ciudad_id' => $var['ciudades']
        ]);

        DB::table('Empleado')->insert([
            'fechaInicio' => $var['fecha_Inic'],
            'Persona_id' => $id,
            'Centro_Distribucion_id' => $var['centro_Dist'],
            'Tipo_Empleado_id' => $var['tipoEmp']
        ]);

        return redirect('/')->with('status', 'Ha sido registrado en el sistema exitosamente!');;
    }
    
}
