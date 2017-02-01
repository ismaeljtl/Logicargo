@extends('layouts.master')

@section('site-section', 'welcome')

@section('header')
@yield('header')

@section('main')

<h2 style="text-align: center">Historico Empelados</h2>
<div class="col-sm-8 col-sm-offset-2">
    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>Correo</th> 
            <th>Acción</th>
            <th>Fecha y Hora</th>
        </tr>
        @for ($i = 0; $i < count($array); $i++)
            <tr>
                <td>{{$array[$i]->id_Persona}}</td>
                <td>{{$array[$i]->user}}</td> 
                <td>{{$array[$i]->accion}}</td> 
                <td>{{$array[$i]->fechaHora}}</td>
            </tr>
    @endfor
    </table>
    <div style="text-align:center" class="regresar">
        <a href="{{url('/')}}">Regresar</a>
    </div>
</div>

@endsection