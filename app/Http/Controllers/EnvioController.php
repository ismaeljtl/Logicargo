<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class EnvioController extends Controller
{
   
    public function index()
    {
        $centros_distribucion = DB::table('Centro_Distribucion')->select('id', 'nombre')->orderBy('nombre', 'asc')->get();
        return view('form.paquete',['centros_distribucion' => $centros_distribucion]);
    }

    public function realizarEnvio(){
        
    }

}
