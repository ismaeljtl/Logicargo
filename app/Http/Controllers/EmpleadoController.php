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

    public function getJefes(){
        $jefes = DB::table('Empleado')->select('id')
                                         ->where('Tipo_Empleado_id', '=', '2')
                                         ->orderBy('id', 'asc')
                                         ->get();
        return json_encode($jefes, true);
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
            'Ciudad_id' => $var['centro_Dist']
        ]);

        DB::table('Historico_Usuario')->insert([
            'fechaHora' => date("Y-m-d H:i:s"),
            'accion' => 'registro',
            'id_Persona' => $id,
            'user' => $var['correo']
        ]);

        if ($var['tipoEmp'] == 2){
            DB::table('Empleado')->insert([
                'fechaInicio' => $var['fecha_Inic'],
                'Persona_id' => $id,
                'Centro_Distribucion_id' => $var['centro_Dist'],
                'Tipo_Empleado_id' => $var['tipoEmp'],
                'Jefe_id' => $var['Jefe_id']
            ]);
        }
        else{
            DB::table('Empleado')->insert([
                'fechaInicio' => $var['fecha_Inic'],
                'Persona_id' => $id,
                'Centro_Distribucion_id' => $var['centro_Dist'],
                'Tipo_Empleado_id' => $var['tipoEmp']
            ]);
        }

        Auth::loginUsingId($id,true);
        return redirect('/')->with('status', 'Ha sido registrado en el sistema exitosamente!');
    }

    public function eliminar(){
        $user = Auth::user()->user;
        $id = Auth::id();
        Auth::logout();

        DB::table('Historico_Usuario')->insert([
            'fechaHora' => date("Y-m-d H:i:s"),
            'accion' => 'eliminar',
            'id_Persona' => $id,
            'user' => $user
        ]);

        DB::table('Empleado')->where('Persona_id', '=', $id)->delete();
        DB::table('Persona')->where('user', '=', $user)->delete();
        
        return redirect('/')->with('status', 'Ha sido eliminado del sistema exitosamente!');
    }
    
}
