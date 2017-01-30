@extends('layouts.master')

@section('site-section', 'register-persona')

@section('main')

    <div class="container-horizontal">
        <form class="form-group" action="{{route('actualizaEmp')}}" method="post">
        {{ csrf_field() }}
        <div class="col-sm-4 col-sm-offset-4">
            <h2>Actualización de Datos</h2>
            <br/>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Correo de Usuario</label>
                <div class="col-lg-9">
                    <input readonly="readonly" class="form-control" type="email" id="correo" name="correo" value="{{$array['usuario'][0]->user}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Nombre</label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" id="nombre" name="nombre" value="{{$array['usuario'][0]->nombre}}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Segundo Nombre</label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" id="2doNombre" name="segundo_nombre" value="{{$array['usuario'][0]->segundo_nombre}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Apellido</label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" id="apellido" name="apellido" value="{{$array['usuario'][0]->apellido}}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Segundo Apellido</label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" id="2doApellido" name="segundo_apellido" value="{{$array['usuario'][0]->segundo_apellido}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Cédula de Identidad</label>
                <div class="col-lg-9">
                    <input class="form-control" type="text" id="cedula" name="cedula" value="{{$array['usuario'][0]->cedula}}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Fecha de Nacimiento</label>
                <div class="col-lg-9">
                    <label class="col-form-label">Formato: YYYY-MM-DD</label>
                    <input class="form-control" type="text" id="fechaNac" name="fecha_Nac" value="{{$array['usuario'][0]->fecha_Nac}}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Fecha de Inicio</label>
                <div class="col-lg-9">
                    <label class="col-form-label">Formato: YYYY-MM-DD</label>
                    <input class="form-control" type="text" id="fechaInic" name="fechaInic" value="{{$array['usuario'][0]->fechaInicio}}" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Fecha de Fin</label>
                <div class="col-lg-9">
                    <label class="col-form-label">Formato: YYYY-MM-DD</label>
                    <input class="form-control" type="text" id="fechaFin" name="fechaFin" value="{{$array['usuario'][0]->fechaFin}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">Centro de Distribucion</label>
                <div class="col-lg-9">
                <select class="form-control" id="CentroDist" name="CentroDist" required>
                    @foreach($array['ciudades'] as $ciudad)
                        @if ($ciudad->id == $array['usuario'][0]->Centro_Distribucion_id)
                            <option value="{{$ciudad->id}}" selected>{{$ciudad->nombre}}</option>
                        @else
                            <option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Cargo</label>
            <div class="col-lg-9">
                <select class="form-control" id="tipoEmp" name="tipoEmp" required>
                @foreach($array['cargos'] as $cargos)
                    @if ($cargos->id == $array['usuario'][0]->Tipo_Empleado_id)
                        <option value="{{$cargos->id}}" selected>{{$cargos->tipo}}</option>
                    @else
                        <option value="{{$cargos->id}}">{{$cargos->tipo}}</option>
                    @endif
                @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row" id="jefe" name="jefe" style="display: none;">
            <label class="col-lg-3 col-form-label">Id Jefe</label>
            <div class="col-lg-9">
                <select class="form-control" id="Jefeid" name="Jefe_id">
                @foreach($array['jefes'] as $jefes)
                    <option value="{{$jefes->Persona_id}}">{{$jefes->Persona_id}}</option>
                @endforeach
                </select>
            </div>
        </div>

            
        <div class="btn-submit" style="text-align:center;">
            <button type="submit" class="btn btn-info" id="businessForm">Enviar</button>
        </div>
        <br/>
        <div class="col-lg-12 regresar">
            <a href="{{route('actualizaEmpleado')}}">Regresar</a>
        </div>
        </form>
    </div>

@endsection