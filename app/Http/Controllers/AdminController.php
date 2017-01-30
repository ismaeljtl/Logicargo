<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
   public function ConsultaClientes(){
        $clientes = DB::table('Persona')->select('*')
                                         ->where('rol', '=', 'persona')
                                         ->orderBy('user', 'asc')
                                         ->get();

        return view('admin.consultaClientes')->with('clientes', json_decode(json_encode($clientes, true)));
   }

   public function ConsultaEmpleados(){
        $empleados = DB::table('Persona')->join('Empleado', 'Persona.id', '=', 'Empleado.Persona_id')
                                         ->join('Tipo_Empleado', 'Tipo_Empleado.id', '=', 'Empleado.Tipo_Empleado_id')
                                         ->join('Ciudad', 'Persona.id', '=', 'Empleado.Persona_id')
                                         ->select('Empleado.*', 'Persona.*', 'Tipo_Empleado.tipo', 'Ciudad.nombre as nombreCiudad')
                                         ->orderBy('user', 'asc')
                                         ->groupBy('Empleado.Persona_id')
                                         ->get();

        return view('admin.consultaEmpleados')->with('empleados', json_decode(json_encode($empleados, true)));
   }

   public function actualizaClientes(){
       $clientes = DB::table('Persona')->select('*')
                                         ->where('rol', '=', 'persona')
                                         ->orderBy('user', 'asc')
                                         ->get();

       return view('admin.actualizaClientes')->with('clientes', json_decode(json_encode($clientes, true)));
   }

   public function CargaClientes($id){
        $usuario = DB::table('Persona')->where('id', '=', $id)->select()->get();
        $ciudades = DB::table('Ciudad')->select('id', 'nombre')->orderBy('nombre', 'asc')->get();

        return view('admin.actualizacionClientes')->with('array', array('usuario' => $usuario, 'ciudades' => $ciudades));
   }

   public function actualizaCli(Request $request){
        $var = $request->all();

        $id = DB::table('Persona')->where('user', '=', $var['correo'])->select('id')->get();
        $id = $id[0]->id;

        DB::table('Persona')
        ->where('id', $id)
        ->update(['user' => $var['correo'],
                'nombre' => $var['nombre'],
                'segundo_nombre' => $var['segundo_nombre'],
                'apellido' => $var['apellido'],
                'segundo_apellido' => $var['segundo_apellido'],
                'fecha_Nac' => $var['fecha_Nac'],
                'cedula' => $var['cedula'],
                'Ciudad_id' => $var['ciudades'],
        ]);
        
        DB::table('Historico_Usuario')->insert([
            'fechaHora' => date("Y-m-d H:i:s"),
            'accion' => 'actualizacion',
            'id_Persona' => $id,
            'user' => $var['correo']
        ]);
        return redirect('/')->with('status', 'Los datos han sido actualizados exitosamente!');
        
   }
}
