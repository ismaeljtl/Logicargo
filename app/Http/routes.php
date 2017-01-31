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
    return view('site.index');
});

Route::get('/home', function () {
    return view('site.index');
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

Route::get('getPersonas', [
            'uses' => 'PersonaController@getPersonas',
            'as' => 'getPersonas',
]);

//Rutas para Login de Usuarios
Route::post('Login', 'Auth\AuthController@postLogin');
Route::get('Logout', 'Auth\AuthController@getLogout');

//Rutas para Eliminar Usuarios
Route::get('eliminarCliente', [
            'uses' => 'PersonaController@eliminar',
            'as' => 'eliminarCliente',
]);

Route::get('eliminarEmpleado', [
            'uses' => 'EmpleadoController@eliminar',
            'as' => 'eliminarEmpleado',
]);

//Rutas para Actualizar Usuarios
//Cliente
Route::get('actualizarCliente',[
            'uses' => 'PersonaController@actualizar',
            'as' => 'actualizar',
]);

// Rutas para envíos{
      Route::get('/nuevo_envio', 'EnvioController@index');
      Route::post('/realizar_envio', 'EnvioController@realizarEnvio');
//}

Route::post('actualizarPersona',[
            'uses' => 'PersonaController@actualizarPersona',
            'as' => 'actualizarPersona',
]);

//Empleado
Route::get('actualizarEmp',[
            'uses' => 'EmpleadoController@actualizarEmp',
            'as' => 'actualizarEmp',
]);

Route::post('actualizarEmpleado',[
            'uses' => 'EmpleadoController@actualizarEmpleado',
            'as' => 'actualizarEmpleado',
]);

//-------------------------------------------------------------
//Administrador
//Consultas
Route::get('ConsultaClientes',[
            'uses' => 'AdminController@ConsultaClientes',
            'as' => 'ConsultaClientes',
]);
Route::get('ConsultaEmpleados',[
            'uses' => 'AdminController@ConsultaEmpleados',
            'as' => 'ConsultaEmpleados',
]);
//Actulizaciones Clientes
Route::get('actualizaClientes',[
            'uses' => 'AdminController@actualizaClientes',
            'as' => 'actualizaClientes',
]);
Route::get('cargaClientes/{id}',[
            'uses' => 'AdminController@cargaClientes',
            'as' => 'cargaClientes',
]);
Route::post('actualizaCli', [
            'uses' => 'AdminController@actualizaCli',
            'as' => 'actualizaCli',
]);
//Actualizaciones Empleados
Route::get('actualizaEmpleado',[
            'uses' => 'AdminController@actualizaEmpleado',
            'as' => 'actualizaEmpleado',
]);
Route::get('cargaEmpleados/{id}',[
            'uses' => 'AdminController@cargaEmpleados',
            'as' => 'cargaEmpleados',
]);
Route::post('actualizaEmp', [
            'uses' => 'AdminController@actualizaEmp',
            'as' => 'actualizaEmp',
]);
//Eliminar Cliente
Route::get('eliminaCliente',[
            'uses' => 'AdminController@eliminaCliente',
            'as' => 'eliminaCliente',
]);
Route::get('eliminarClientes/{id}/{user}',[
            'uses' => 'AdminController@eliminarClientes',
            'as' => 'eliminarClientes',
]);
//Eliminar Empleado 
Route::get('eliminaEmpleado',[
            'uses' => 'AdminController@eliminaEmpleado',
            'as' => 'eliminaEmpleado',
]);
Route::get('eliminarEmpleado/{id}/{user}',[
            'uses' => 'AdminController@eliminarEmpleado',
            'as' => 'eliminarEmpleado',
]);