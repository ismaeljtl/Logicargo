@extends('layouts.master')

@section('site-section', 'welcome')

@section('header')
@yield('header')
@section('main')
<div class="col-sm-8 col-sm-offset-2">
    <div class="container-horizontal">        
		<form class="form-group" method="POST" action="{{url('/registrar_entrega')}}">
            {{ csrf_field() }}
            <div class="col-sm-12">
                <h2 style="text-align: center">Gestión de itinerario</h2>
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
                            <th>Entregado</th>
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
                            <td>
                                @if($itinerario->firma_Conf)
                                    <span class="glyphicon glyphicon-ok"></span>
                                @else
                                    <input style="margin-left: -10px;" type="checkbox" name="paquete_id" value="{{$paquete->id}}" required>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="btn-submit" style="text-align:center;">
                    <button type="submit" class="btn btn-info" id="businessForm" @if($itinerario->firma_Conf) disabled @endif>Actualizar</button>
                </div>
                <br>
                <div style="text-align:center" class="regresar">
                    <a href="{{url('/gestion_paquetes')}}">Regresar</a>
                    <br><br>
                </div>
            </div>
         </form>
    </div>
</div>

@endsection