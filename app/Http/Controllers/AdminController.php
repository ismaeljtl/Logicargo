<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
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

   
}
