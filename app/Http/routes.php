<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('site.welcome');
});
Route::get('indexCli', function () {
    return view('site.indexCli');
});
Route::get('indexEmp', function () {
    return view('site.indexEmp');
});

//Registro de personas
Route::get('formPersona', [
            'uses' => 'PersonaController@index',
            'as' => 'formPersona',     
      ]);
Route::post('createPersona', [
            'uses' => 'PersonaController@create',
            'as' => 'createPersona',     
      ]);
      
Route::get('formEmpleado', [
            'uses' => 'EmpleadoController@index',
            'as' => 'formEmpleado',     
      ]);
Route::post('createEmpleado', [
            'uses' => 'EmpleadoController@create',
            'as' => 'createEmpleado',     
      ]);

Route::get('getCiudades', [
            'uses' => 'PersonaController@getCiudades',
            'as' => 'getCiudades',
      ]);

Route::get('getJefes', [
            'uses' => 'EmpleadoController@getJefes',
            'as' => 'getJefes',
      ]);

//Rutas para Login de Usuarios
Route::post('Login', 'Auth\AuthController@postLogin');
Route::get('Logout', 'Auth\AuthController@getLogout');

//Rutas para Eliminar Usuarios
Route::get('eliminarUsuario', [
            'uses' => 'PersonaController@eliminar',
            'as' => 'eliminarUsuario',
      ]);

//Rutas para Actualizar Usuarios
Route::get('actualizar',[
            'uses' => 'PersonaController@actualizar',
            'as' => 'actualizar',
      ]);

// Rutas para envíos{
      Route::get('/nuevo_envio', 'EnvioController@index');
      Route::post('/realizar_envio', 'EnvioController@realizarEnvio');
//}