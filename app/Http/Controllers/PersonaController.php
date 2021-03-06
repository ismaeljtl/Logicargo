<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Paquete;

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

        DB::table('Historico_Usuario')->insert([
            'fechaHora' => date("Y-m-d H:i:s"),
            'accion' => 'registro',
            'id_Persona' => $id,
            'user' => $var['correo'],
            'rol' => 'cliente'
        ]);

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
            'user' => $user,
            'rol' => 'cliente'
        ]);

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
        return view('form.actualizarCliente', array('usuario' => $usuario));
    }

    public function actualizarPersona(Request $request){
        $var = $request->all();

        if (strcmp($var['clave'], $var['clave1']) == 0){
            DB::table('Persona')
            ->where('id', Auth::id())
            ->update(['user' => $var['correo'],
                     'password' => Hash::make($var['clave'])
            ]);
            
            DB::table('Historico_Usuario')->insert([
                'fechaHora' => date("Y-m-d H:i:s"),
                'accion' => 'actualizacion',
                'id_Persona' => Auth::id(),
                'user' => $var['correo'],
                'rol' => 'cliente'
            ]);
            return redirect('/')->with('status', 'Sus datos han sido actualizados exitosamente!');
        }
        else{
            return redirect('actualizarCliente')->with('status', 'Las claves no coinciden, verifique nuevamente');
        }
    }

    public function getPersonas(){
        $correos = DB::table('Persona')->select('user')->orderBy('user', 'asc')->get();
        return json_encode($correos, true);
    }

    public function paquetesEnviados(){
        $paquetes = Paquete::select()
            ->join('Centro_Distribucion as C1','C1.id','=','Paquete.Centro_Distribucion_idEmisor')
            ->join('Centro_Distribucion as C2','C2.id','=','Paquete.Centro_Distribucion_idReceptor')
            ->select(DB::raw(
                'Paquete.id, 
                Paquete.peso, 
                Paquete.volumen,
                Paquete.fragilidad,  
                Paquete.prioridad, 
                (select nombre from Persona where id=Paquete.Persona_idEmisor) as personaEmisor,
                (select nombre from Persona where id=Paquete.Persona_idReceptor) as personaReceptor,
                C1.nombre as centroEmisor,
                C2.nombre as centroReceptor,
                (select count(*) from Itinerario where Paquete_id = Paquete.id) as numItinerario'
            ))
            ->where('Paquete.Persona_idEmisor',Auth::user()->id)
            ->get();

        return view('paquetes.paquetes_enviados',['paquetes' => $paquetes]);
    }

    public function paquetesRecibidos(){
        $paquetes = Paquete::select()
            ->join('Centro_Distribucion as C1','C1.id','=','Paquete.Centro_Distribucion_idEmisor')
            ->join('Centro_Distribucion as C2','C2.id','=','Paquete.Centro_Distribucion_idReceptor')
            ->select(DB::raw(
                'Paquete.id, 
                Paquete.peso, 
                Paquete.volumen,
                Paquete.fragilidad,  
                Paquete.prioridad, 
                (select nombre from Persona where id=Paquete.Persona_idEmisor) as personaEmisor,
                (select nombre from Persona where id=Paquete.Persona_idReceptor) as personaReceptor,
                C1.nombre as centroEmisor,
                C2.nombre as centroReceptor,
                (select count(*) from Itinerario where Paquete_id = Paquete.id) as numItinerario'
            ))
            ->where('Paquete.Persona_idReceptor',Auth::user()->id)
            ->get();

        return view('paquetes.paquetes_recibidos',['paquetes' => $paquetes]);
    }

}
