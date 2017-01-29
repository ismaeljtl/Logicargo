@extends('layouts.master')

@section('site-section', 'register-persona')

@section('main')

    <div class="container-horizontal">
		<form class="form-group" method="POST" action="{{url('/realizar_envio')}}">
		{{ csrf_field() }}
		<!-- El offset en la columna hace que se desplace la cantidad indicada de columnas hacia la derecha -->
		<div class="col-sm-4 col-sm-offset-4">
	        <h2>Formulario de envío</h2>
	        <br/>
			<div class="form-group row">
                <label class="col-lg-3 col-form-label">*Peso (Kg)</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="peso" name="peso" required>
				</div>
			</div>
			<div class="form-group row">
                <label class="col-lg-3 col-form-label">*Altura (cm)</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="altura" name="altura" required>
				</div>
			</div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">*Ancho (cm)</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="ancho" name="ancho" required>
				</div>
			</div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label">*Largo (cm)</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="largo" name="largo" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">*Desde</label>
				<div class="col-lg-9">
				<select class="form-control" id="centro_emisor" name="centro_emisor" required>
                    @foreach($centros_distribucion as $centro)
						<option value="{{$centro->id}}">{{$centro->nombre}}</option>
					@endforeach
				</select>
				</div>
			</div>
            <div class="form-group row">
				<label class="col-lg-3 col-form-label">*Hasta</label>
				<div class="col-lg-9">
				<select class="form-control" id="centro_receptor" name="centro_receptor" required>
                    @foreach($centros_distribucion as $centro)
						<option value="{{$centro->id}}">{{$centro->nombre}}</option>
					@endforeach
				</select>
				</div>
			</div>
            <div class="form-group row">
				<label class="col-lg-12 col-form-label">Datos de la persona que recibirá el paquete</label>
			</div>
            <div class="form-group row">
				<label class="col-lg-3 col-form-label">*Cédula de Identidad</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="cedula_receptor" name="cedula_receptor" required>
				</div>
			</div>
			<div class="btn-submit" style="text-align:center;">
                <button type="submit" class="btn btn-info" id="businessForm">Enviar</button>
            </div>
			<br/>
			<div class="col-lg-12 regresar">
				<h5>Campos obligatorios (*)</h5>
				<a href="{{url('/')}}">Regresar</a>
			</div>
	    </div>
	    </form>
    </div>

@endsection