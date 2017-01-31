<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Persona;
use App\Empleado;
use App\Tipo_Empleado;

class EmpleadoController extends Controller
{
    public function index(){
        return view("form.empleado");
    }

    public function getJefes(){
        $jefes = DB::table('Empleado')->select('Persona_id')
                                         ->where('Tipo_Empleado_id', '=', '1')
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
        
        $empleado = Empleado::select()->where('Persona_id',Auth::user()->id)->first(); 
        $CentroDistribucion = Centro_Distribucion::select()->where('id',$empleado->Centro_Distribucion_id)->first(); 
        $tipoEmpleado = Tipo_Empleado::select()->where('id',$empleado->Tipo_Empleado_id)->first(); 
        session()->put('centro_distribucion', $CentroDistribucion->nombre);
        session()->put('tipo_empleado_id',$empleado->Tipo_Empleado_id);
        session()->put('tipo_empleado_tipo',$tipoEmpleado->tipo);
            
        return redirect('/')->with('status', 'Ha sido registrado en el sistema exitosamente!');
    }

    public function actualizarEmp(){
        $usuario = DB::table('Persona')->where('id', '=', Auth::id())->select()->get();
        $empleado = array();
        if (strcmp($usuario[0]->rol, 'empleado') == 0){
            $empleado = DB::table('Empleado')->where('Persona_id', '=', Auth::id())->select()->get();
        }        
        return view('form.actualizarEmpleado', array('usuario' => $usuario, 'empleado' => $empleado));
    }

    public function actualizarEmpleado(Request $request){
        $var = $request->all();

        if (strcmp($var['clave'], $var['clave1']) == 0){
            DB::table('Persona')
            ->where('id', Auth::id())
            ->update(['user' => $var['correo'],
                     'password' => Hash::make($var['clave'])
            ]);
            DB::table('Empleado')
            ->where('Persona_id', Auth::id())
            ->update(['Centro_Distribucion_id' => $var['centro_Dist']]);

            DB::table('Historico_Usuario')->insert([
                'fechaHora' => date("Y-m-d H:i:s"),
                'accion' => 'actualizacion',
                'id_Persona' => Auth::id(),
                'user' => $var['correo']
            ]);

            return redirect('/')->with('status', 'Sus datos han sido actualizados exitosamente!');
        }
        else{
            return redirect('actualizarCliente')->with('status', 'Las claves no coinciden, verifique nuevamente');
        }
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
        DB::table('Persona')->where('id', '=', $id)->delete();
        
        return redirect('/')->with('status', 'Ha sido eliminado del sistema exitosamente!');
    }
    
}
