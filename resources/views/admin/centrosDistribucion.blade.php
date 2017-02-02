@extends('layouts.master')

@section('site-section', 'welcome')

@section('header')
@yield('header')
@section('main')
<h2 style="text-align: center">Elija un Centro de Distribucion para Mostrar sus Empleados</h2>
<div class="col-sm-4 col-sm-offset-4">
    <form class="form-group" action="{{ route('EmpleadosXCD') }}" method="get">
        <select class="form-control" id="CentroDist" name="CentroDist" required>
            @foreach($array as $ciudad)
                <option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
            @endforeach
        </select>
        <br/>
        <div class="btn-submit" style="text-align:center;">
            <button type="submit" class="btn btn-info" id="businessForm">Enviar</button>
        </div>
    </form>
    <div style="text-align:center" class="regresar">
        <a href="{{url('/')}}">Regresar</a>
    </div>
</div>

@endsection