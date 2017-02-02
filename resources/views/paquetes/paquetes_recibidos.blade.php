@extends('layouts.master')

@section('site-section', 'welcome')

@section('header')
@yield('header')
@section('main')
<h2 style="text-align: center">Paquetes Recibidos</h2>
<div class="col-sm-8 col-sm-offset-2">
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
                <th>Historico</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paquetes as $paquete)
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
                    <td>
                        <form class="form-group" method="POST" action="{{url('/historico_paquete')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="paquete_id" value="{{$paquete->id}}">
                            <button type="submit" class="submit-table">
                                <span>Ver Historico</span>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="text-align:center" class="regresar">
        <a href="{{url('/')}}">Regresar</a>
    </div>
</div>

@endsection