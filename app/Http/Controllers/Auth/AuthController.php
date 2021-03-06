<?php

namespace App\Http\Controllers\Auth;

use App\Persona;
use App\Empleado;
use App\Tipo_Empleado;
use App\Centro_Distribucion;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /*protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }*/

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt(['user' => $request->input("user"),'password' => $request->input("password")],true))
        {
            $empleado = Empleado::select()->where('Persona_id',Auth::user()->id)->first(); 
            if(count($empleado)>0){
                $CentroDistribucion = Centro_Distribucion::select()->where('id',$empleado->Centro_Distribucion_id)->first(); 
                $tipoEmpleado = Tipo_Empleado::select()->where('id',$empleado->Tipo_Empleado_id)->first(); 
                session()->put('centro_distribucion', $CentroDistribucion->nombre);
                session()->put('tipo_empleado_id',$empleado->Tipo_Empleado_id);
                session()->put('tipo_empleado_tipo',$tipoEmpleado->tipo);
            }
            return redirect('/'); 
        }
        else{
            return redirect('/')->with('status', 'ERROR! No has podido entrar a la aplicacion. Verifica Correo y Clave.');
        }
    }

    public function getLogout(){   
        Auth::logout();
        session()->flush();
        return redirect('/'); 
    }
}
