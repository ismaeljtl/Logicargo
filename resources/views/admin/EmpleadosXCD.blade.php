@extends('layouts.master')

@section('site-section', 'welcome')

@section('header')
@yield('header')
@section('main')

<h2 style="text-align: center">Empleados de {{$array[0]->nombreCiudad}}</h2>
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
            <th>Cargo</th>
            <th>Centro de Dist.</th>
        </tr>
        @for ($i = 0; $i < count($array); $i++)
            <tr>
                <td>{{$array[$i]->id}}</td>
                <td>{{$array[$i]->user}}</td> 
                <td>{{$array[$i]->nombre}}</td> 
                <td>{{$array[$i]->segundo_nombre}}</td>
                <td>{{$array[$i]->apellido}}</td> 
                <td>{{$array[$i]->segundo_apellido}}</td> 
                <td>{{$array[$i]->fecha_Nac}}</td> 
                <td>{{$array[$i]->cedula}}</td> 
                <td>{{$array[$i]->tipo}}</td>
                <td>{{$array[$i]->nombreCiudad}}</td>
            </tr>
        @endfor
    </table>
    
    <div style="text-align:center" class="regresar">
        <a href="{{route('CentrosDist')}}">Regresar</a>
    </div>
</div>

@endsection