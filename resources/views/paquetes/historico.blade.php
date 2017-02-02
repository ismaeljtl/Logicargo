@extends('layouts.master')

@section('site-section', 'welcome')

@section('header')
@yield('header')
@section('main')
<div class="col-sm-8 col-sm-offset-2">
    <div class="col-sm-12">
        <h2 style="text-align: center">Datos de paquete</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Peso</th>
                    <th>Volumen</th>
                    <th>Fragilidad</th>
                    <th>Prioridad</th>
                    <th>Emisor</th>
                    <th>Receptor</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$paquete->id}}</td>
                    <td>{{$paquete->peso}}Kg</td>
                    <td>{{$paquete->volumen}}cm<SUP>3</SUP></td>
                    <td>
                        @if($paquete->fragilidad)
                            <span class="glyphicon glyphicon-ok"></span>
                        @else
                            <span class="glyphicon glyphicon-remove"></span>
                        @endif
                    </td>
                    <td>
                        @if($paquete->prioridad)
                            <span class="glyphicon glyphicon-ok"></span>
                        @else
                            <span class="glyphicon glyphicon-remove"></span>
                        @endif
                    </td>
                    <td>{{$paquete->personaEmisor}}</td>
                    <td>{{$paquete->personaReceptor}}</td>
                    <td>{{$paquete->centroEmisor}}</td>
                    <td>{{$paquete->centroReceptor}}</td>
                </tr>
            </tbody>
        </table>

        <h2 style="text-align: center">Historico</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historicoPaquete as $historia)
                    <tr>
                        <td>{{$historia->fechaHora}}</td>
                        <td>{{$historia->estatusPaquete}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="text-align:center" class="regresar">
        <a href="{{url('/gestion_paquetes')}}">Regresar</a>
    </div>
</div>

@endsection