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
            if($tipoEmpleado->id==1)
                return view('employee.gestion_paquete');
        }
        return redirect('/');

    }

}
