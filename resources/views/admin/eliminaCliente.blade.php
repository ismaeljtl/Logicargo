@extends('layouts.master')

@section('site-section', 'welcome')

@section('header')
@yield('header')
@section('main')
<h2 style="text-align: center">Clientes</h2>
<div class="col-sm-8 col-sm-offset-2">
    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>Correo</th> 
            <th>Nombre</th>
            <th>Segundo Nombre</th>
            <th>Apellido</th> 
            <th>Segundo Apellido</th>
            <th>Fecha de Nacimiento</th>
            <th>Cedula</th>
            <th>Centro de Distribución</th>
            <th>Eliminar</th>
        </tr>
        @for ($i = 0; $i < count($clientes); $i++)
            <tr>
                <td>{{$clientes[$i]->id}}</td>
                <td>{{$clientes[$i]->user}}</td> 
                <td>{{$clientes[$i]->nombre}}</td> 
                <td>{{$clientes[$i]->segundo_nombre}}</td>
                <td>{{$clientes[$i]->apellido}}</td> 
                <td>{{$clientes[$i]->segundo_apellido}}</td> 
                <td>{{$clientes[$i]->fecha_Nac}}</td> 
                <td>{{$clientes[$i]->cedula}}</td> 
                <td>{{$clientes[$i]->nombreCiudad}}</td>
                <td><a href="eliminarClientes/{{$clientes[$i]->id}}/{{$clientes[$i]->user}}"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
            </tr>
    @endfor
    </table>
    <div style="text-align:center" class="regresar">
        <a href="{{url('/')}}">Regresar</a>
    </div>
</div>

@endsection