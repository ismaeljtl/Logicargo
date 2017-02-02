@extends('layouts.master')

@section('site-section', 'register-persona')

@section('main')
<div class="col-sm-8 col-sm-offset-2">
    <div class="container-horizontal">        
		<form class="form-group" method="POST" action="enviar_intinerario">
            {{ csrf_field() }}
            <input type="hidden" name="paquete_id" value="{{$paquete->id}}" requiered>
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
                <h2>Asignación de itinerario</h2>
                <h3>Elección de vehículo</h3>
                <br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Color</th>
                            <th>Placa</th>
                            <th>Capacidad Max</th>
                            <th>Capacidad Min</th>
                            <th>Año</th>
                            <th>Seleccionar</th>
                        </tr>                    
                    </thead>
                    <tbody>
                        @foreach($vehiculos as $vehiculo)
                            <tr>
                                <td>{{$vehiculo->marca}}</td>
                                <td>{{$vehiculo->modelo}}</td>
                                <td>{{$vehiculo->color}}</td>
                                <td>{{$vehiculo->placa}}</td>
                                <td>{{$vehiculo->maxCapPaq}}Kg</td>
                                <td>{{$vehiculo->minCapPaq}}Kg</td>
                                <td>{{$vehiculo->anio}}</td>
                                <td>
                                    @if($vehiculo->Estado_Vehiculo_id==1)
                                        <input type="radio" name="vehiculo_id" value="{{$vehiculo->id}}" requiered>
                                    @else
                                        {{$vehiculo->estadoVehiculo}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                 </table>

                <div class="btn-submit" style="text-align:center;">
                    <button type="submit" class="btn btn-info" id="businessForm">Asignar</button>
                </div>
                <br/>
                <div class="col-lg-12 regresar">
                    <a href="{{url('/gestion_paquetes')}}">Regresar</a>
                    <br><br>
                </div>
            </div>
	    </form>
    </div>


@endsection