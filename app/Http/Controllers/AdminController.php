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
        $clientes = DB::table('Persona')->select('Persona.*', 'Ciudad.nombre as nombreCiudad')
                                        ->join('Ciudad', 'Ciudad.id', '=', 'Persona.Ciudad_id')
                                         ->where('rol', '=', 'persona')
                                         ->orderBy('user', 'asc')
                                         ->get();

        return view('admin.consultaClientes')->with('clientes', json_decode(json_encode($clientes, true)));
   }

   public function ConsultaEmpleados(){
        $empleados = DB::table('Persona')->join('Empleado', 'Persona.id', '=', 'Empleado.Persona_id')
                                         ->join('Tipo_Empleado', 'Tipo_Empleado.id', '=', 'Empleado.Tipo_Empleado_id')
                                         ->join('Ciudad', 'Ciudad.id', '=', 'Empleado.Centro_Distribucion_id')
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
            'user' => $var['correo'],
            'rol' => 'cliente'
        ]);
        return redirect('/')->with('status', 'Los datos han sido actualizados exitosamente!');
        
   }

   public function actualizaEmpleado(){
       $empleados = DB::table('Persona')->select('*')
                                         ->where('rol', '=', 'empleado')
                                         ->orderBy('user', 'asc')
                                         ->get();

       return view('admin.actualizaEmpleados')->with('empleados', json_decode(json_encode($empleados, true)));
   }

   public function cargaEmpleados($id){
        $usuario = DB::table('Persona')->join('Empleado', 'Persona.id', '=', 'Empleado.Persona_id')
                                       ->select('Empleado.*', 'Persona.*')
                                       ->groupBy('Empleado.Persona_id')
                                       ->where('Persona.id', '=', $id)
                                       ->get();

        $ciudades = DB::table('Ciudad')->select('id', 'nombre')->orderBy('nombre', 'asc')->get();
        $cargos = DB::table('Tipo_Empleado')->select('*')->orderBy('id', 'asc')->where('id', '<>', 6)->get();
        $jefes = DB::table('Empleado')->select('Persona_id')->where('Tipo_Empleado_id', '=', 1)->get();

        return view('admin.actualizacionEmpleados')->with('array', array('usuario' => $usuario, 
                                                                         'ciudades' => $ciudades,
                                                                         'cargos' => $cargos,
                                                                         'jefes' => $jefes ));
   }

   public function actualizaEmp(Request $request){
        $var = $request->all();

        $id = DB::table('Persona')->where('user', '=', $var['correo'])->select('id')->get();
        $id = $id[0]->id;

        DB::table('Persona')->where('id', $id)
                            ->update(['user' => $var['correo'],
                                    'nombre' => $var['nombre'],
                                    'segundo_nombre' => $var['segundo_nombre'],
                                    'apellido' => $var['apellido'],
                                    'segundo_apellido' => $var['segundo_apellido'],
                                    'fecha_Nac' => $var['fecha_Nac'],
                                    'cedula' => $var['cedula'],
                                    'Ciudad_id' => $var['CentroDist'],
                            ]);

        if ($var['tipoEmp'] == 2){
            DB::table('Empleado')->where('Persona_id', $id)
                                 ->update([
                                     'fechaInicio' => $var['fecha_Inic'],
                                     'fechaFin' => $var['fechaFin'],
                                     'Persona_id' => $id,
                                     'Centro_Distribucion_id' => $var['CentroDist'],
                                     'Tipo_Empleado_id' => $var['tipoEmp'],
                                     'Jefe_id' => $var['Jefe_id']
                                 ]);
        }
        else{
            DB::table('Empleado')->where('Persona_id', $id)
                                 ->update([
                                     'fechaInicio' => $var['fechaInic'],
                                     'fechaFin' => $var['fechaFin'],
                                     'Persona_id' => $id,
                                     'Centro_Distribucion_id' => $var['CentroDist'],
                                     'Tipo_Empleado_id' => $var['tipoEmp']
                                 ]);
        }
        
        DB::table('Historico_Usuario')->insert([
            'fechaHora' => date("Y-m-d H:i:s"),
            'accion' => 'actualizacion',
            'id_Persona' => $id,
            'user' => $var['correo'],
            'rol' => 'empleado'
        ]);
        return redirect('/')->with('status', 'Los datos han sido actualizados exitosamente!');
        
   }

   public function eliminaCliente(){
       $clientes = DB::table('Persona')->select('Persona.*', 'Ciudad.nombre as nombreCiudad')
                                        ->join('Ciudad', 'Ciudad.id', '=', 'Persona.Ciudad_id')
                                         ->where('rol', '=', 'persona')
                                         ->orderBy('user', 'asc')
                                         ->get();

        return view('admin.eliminaCliente')->with('clientes', json_decode(json_encode($clientes, true)));
   }

   public function eliminarClientes($id, $user){
        DB::table('Historico_Usuario')->insert([
            'fechaHora' => date("Y-m-d H:i:s"),
            'accion' => 'eliminar',
            'id_Persona' => $id,
            'user' => $user,
            'rol' => 'cliente'
        ]);

        DB::table('Persona')->where('id', '=', $id)->delete();
        
        return redirect('/')->with('status', 'El Cliente ha sido eliminado del sistema exitosamente!');
   }

   public function eliminaEmpleado(){
       $empleados = DB::table('Persona')->join('Empleado', 'Persona.id', '=', 'Empleado.Persona_id')
                                         ->join('Tipo_Empleado', 'Tipo_Empleado.id', '=', 'Empleado.Tipo_Empleado_id')
                                         ->join('Ciudad', 'Ciudad.id', '=', 'Empleado.Centro_Distribucion_id')
                                         ->select('Empleado.*', 'Persona.*', 'Tipo_Empleado.tipo', 'Ciudad.nombre as nombreCiudad')
                                         ->orderBy('user', 'asc')
                                         ->groupBy('Empleado.Persona_id')
                                         ->get();

        return view('admin.eliminarEmpleado')->with('empleados', json_decode(json_encode($empleados, true)));
   }

   public function eliminarEmpleado($id, $user){
        DB::table('Historico_Usuario')->insert([
            'fechaHora' => date("Y-m-d H:i:s"),
            'accion' => 'eliminar',
            'id_Persona' => $id,
            'user' => $user,
            'rol' => 'empleado'
        ]);

        DB::table('Empleado')->where('Persona_id', '=', $id)->delete();
        DB::table('Persona')->where('id', '=', $id)->delete();
        
        return redirect('/')->with('status', 'El Empleado ha sido eliminado del sistema exitosamente!');
   }

   public function HistoricoClientes(){
       $usuarios = DB::table('Historico_Usuario')->select('Historico_Usuario.*')
                                                ->where('Historico_Usuario.rol', '=', 'cliente')
                                                ->get();

        return view('admin.historicoClientes')->with('array', array('usuarios' => $usuarios));   
   }

   public function HistoricoEmpelados(){
       $usuarios = DB::table('Historico_Usuario')->select('Historico_Usuario.*')
                                                ->where('Historico_Usuario.rol', '=', 'empleado')
                                                ->get();
                                     
        return view('admin.historicoEmpleados')->with('array', json_decode(json_encode($usuarios, true)));
   }
}
