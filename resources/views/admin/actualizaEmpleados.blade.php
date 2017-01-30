@extends('layouts.master')

@section('site-section', 'welcome')

@section('header')
@yield('header')

@section('main')
<h2 style="text-align: center">Empleados</h2>
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
            <th>Editar</th>
        </tr>
        @for ($i = 0; $i < count($empleados); $i++)
            <tr>
                <td>{{$empleados[$i]->id}}</td>
                <td>{{$empleados[$i]->user}}</td> 
                <td>{{$empleados[$i]->nombre}}</td> 
                <td>{{$empleados[$i]->segundo_nombre}}</td>
                <td>{{$empleados[$i]->apellido}}</td> 
                <td>{{$empleados[$i]->segundo_apellido}}</td> 
                <td>{{$empleados[$i]->fecha_Nac}}</td> 
                <td>{{$empleados[$i]->cedula}}</td> 
                <td><a href="cargaEmpleados/{{$empleados[$i]->id}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
            </tr>
    @endfor
    </table>
    <div style="text-align:center" class="regresar">
        <a href="{{url('/')}}">Regresar</a>
    </div>
</div>

@endsection