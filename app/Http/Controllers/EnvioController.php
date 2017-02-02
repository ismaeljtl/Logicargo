<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Paquete;
use App\Persona;
use App\Empleado;
use App\Tipo_Empleado;
use App\Historico_Paquete;
use App\Centro_Distribucion;
use App\Vehiculo;

class EnvioController extends Controller
{
   
    public function index()
    {
        $centros_distribucion = DB::table('Centro_Distribucion')->select('id', 'nombre')->orderBy('nombre', 'asc')->get();
        return view('form.paquete',['centros_distribucion' => $centros_distribucion]);
    }

    public function realizarEnvio(Request $request){
        $receptor = Persona::select()->where('cedula',$request->cedula_receptor)->first(); 
        if(count($receptor)>0){
            $paquete = new Paquete;
            $paquete->peso = $request->peso;
            $paquete->volumen = ($request->altura)*($request->ancho)*($request->largo);
            if ($request->has('fragil'))
                $paquete->fragilidad = true;
            else
                $paquete->fragilidad = false;
            if ($request->has('prioridad'))
                $paquete->prioridad = true;
            else
                $paquete->prioridad = false;
            $paquete->Centro_Distribucion_idEmisor = $request->centro_emisor;
            $paquete->Centro_Distribucion_idReceptor = $request->centro_receptor;
            $paquete->Persona_idEmisor = Auth::user()->id;
            $paquete->Persona_idReceptor = $receptor->id;
            $paquete->save();

            $historicoPaquete = new Historico_Paquete;
            $historicoPaquete->fechaHora = date("Y").'-'.date("m").'-'.date("d").' '.date("H").':'.date("i").':'.date("s");
            $historicoPaquete->estatusPaquete = 'Registrado';
            $historicoPaquete->Paquete_id = $paquete->id;
            $historicoPaquete->save();
             
            return redirect()->back()->with('status', 'Su paquete está siendo preparado para ser enviado!');
        }
        else
            return redirect()->back()->with('status', 'El usuario a quien desea enviarle el paquete no está registrado!');
    }

    public function gestionPaquetes(){
        $empleado = Empleado::select()->where('Persona_id',Auth::user()->id)->first(); 
        if(count($empleado)>0){
            $tipoEmpleado = Tipo_Empleado::select()->where('id',$empleado->Tipo_Empleado_id)->first(); 
            if($tipoEmpleado->id==1){
                $paquetes = DB::table('Paquete')
                    ->join('Persona as P1','P1.id','=','Paquete.Persona_idEmisor')
                    ->join('Persona as P2','P2.id','=','Paquete.Persona_idReceptor')
                    ->join('Centro_Distribucion as C1','C1.id','=','Paquete.Centro_Distribucion_idEmisor')
                    ->join('Centro_Distribucion as C2','C2.id','=','Paquete.Centro_Distribucion_idReceptor')
                    ->select(DB::raw(
                        'Paquete.id, 
                        Paquete.peso, 
                        Paquete.volumen,
                        Paquete.fragilidad,  
                        Paquete.prioridad, 
                        P1.nombre as personaEmisor,
                        P2.nombre as personaReceptor,
                        C1.nombre as centroEmisor,
                        C2.nombre as centroReceptor,
                        (select count(*) from Itinerario where Paquete_id = Paquete.id) as numItinerario'
                    ))
                    ->where('Paquete.Centro_Distribucion_idEmisor',$empleado->Centro_Distribucion_id)
                    ->get();
                return view('paquetes.gestion_paquete',['paquetes' => $paquetes]);
            }
        }
        return redirect('/');

    }

    public function asignarItinerario(Request $request){
        if ($request->isMethod('post')) {
            //$request->paquete_id
            $paquete = Paquete::select()
                    ->join('Persona as P1','P1.id','=','Paquete.Persona_idEmisor')
                    ->join('Persona as P2','P2.id','=','Paquete.Persona_idReceptor')
                    ->join('Centro_Distribucion as C1','C1.id','=','Paquete.Centro_Distribucion_idEmisor')
                    ->join('Centro_Distribucion as C2','C2.id','=','Paquete.Centro_Distribucion_idReceptor')
                    ->select(DB::raw(
                        'Paquete.id, 
                        Paquete.peso, 
                        Paquete.volumen,
                        Paquete.fragilidad,  
                        Paquete.prioridad, 
                        P1.nombre as personaEmisor,
                        P2.nombre as personaReceptor,
                        C1.nombre as centroEmisor,
                        C2.nombre as centroReceptor,
                        (select count(*) from Itinerario where Paquete_id = Paquete.id) as numItinerario'
                    ))
                    ->where('Paquete.id',$request->paquete_id)
                    ->first();

            $centroDistribucion = Centro_Distribucion::select()
                    ->where('nombre',$paquete->centroEmisor)
                    ->first();

            $vehiculos = Vehiculo::select()
                    ->where('Centro_Distribucion_id',$centroDistribucion->id)
                    ->where('maxCapPaq','>=',$paquete->peso)
                    ->select(DB::raw(' Vehiculo.*,
                    (select estado from Estado_Vehiculo where id = Vehiculo.Estado_Vehiculo_id) as estadoVehiculo
                    '))
                    ->get();;

            return view('paquetes.asignacion_itinerario',['paquete' => $paquete, 'vehiculos' => $vehiculos]);
        }
        else{
            $empleado = Empleado::select()->where('Persona_id',Auth::user()->id)->first(); 
            if(count($empleado)>0){
                $tipoEmpleado = Tipo_Empleado::select()->where('id',$empleado->Tipo_Empleado_id)->first(); 
                if($tipoEmpleado->id==1)
                    return redirect('/gestion_paquetes');
            }
        }
        return redirect('/');
    }

    public function enviarItinerario(Request $request){
         //vehiculo_id
        DB::table('Itinerario')->insert([
                'Vehiculo_id' => $request->vehiculo_id,
                'Paquete_id' => $request->paquete_id
        ]);
        DB::table('Historico_Paquete')->insert([
                'fechaHora' => date("Y").'-'.date("m").'-'.date("d").' '.date("H").':'.date("i").':'.date("s"),
                'estatusPaquete' => 'Asignación de itinerario',
                'Paquete_id' => $request->paquete_id
        ]);
        DB::table('Vehiculo')
            ->where('id',$request->vehiculo_id)
            ->update(['Estado_Vehiculo_id' => 2]);

        return redirect('/gestion_paquetes')->with('status', 'Itinerario asignado!');
    }

    public function historicoPaquete(Request $request){
        if ($request->isMethod('post')) {
            $paquete = Paquete::select()
                    ->join('Persona as P1','P1.id','=','Paquete.Persona_idEmisor')
                    ->join('Persona as P2','P2.id','=','Paquete.Persona_idReceptor')
                    ->join('Centro_Distribucion as C1','C1.id','=','Paquete.Centro_Distribucion_idEmisor')
                    ->join('Centro_Distribucion as C2','C2.id','=','Paquete.Centro_Distribucion_idReceptor')
                    ->select(DB::raw(
                        'Paquete.id, 
                        Paquete.peso, 
                        Paquete.volumen,
                        Paquete.fragilidad,  
                        Paquete.prioridad, 
                        P1.nombre as personaEmisor,
                        P2.nombre as personaReceptor,
                        C1.nombre as centroEmisor,
                        C2.nombre as centroReceptor,
                        (select count(*) from Itinerario where Paquete_id = Paquete.id) as numItinerario'
                    ))
                    ->where('Paquete.id',$request->paquete_id)
                    ->first();

            $historicoPaquete = DB::table('Historico_Paquete')
                ->select('fechaHora','estatusPaquete')
                ->where('Paquete_id',$request->paquete_id)
                ->get();

            return view('paquetes.historico',['paquete' => $paquete,'historicoPaquete' => $historicoPaquete]);
        }
        else{
            $empleado = Empleado::select()->where('Persona_id',Auth::user()->id)->first(); 
            if(count($empleado)>0){
                $tipoEmpleado = Tipo_Empleado::select()->where('id',$empleado->Tipo_Empleado_id)->first(); 
                if($tipoEmpleado->id==1)
                    return redirect('/gestion_paquetes');
            }
        }
        return redirect('/');
        
    }
}
