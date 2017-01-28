@extends('layouts.master')

@section('site-section', 'register-persona')

@section('main')

    <div class="container-horizontal">
		<form class="form-group" method="POST" action="createPersona">
		{{ csrf_field() }}
		<!-- El offset en la columna hace que se desplace la cantidad indicada de columnas hacia la derecha -->
		<div class="col-sm-4 col-sm-offset-4">
	        <h2>Registro de Persona Natural</h2>
	        <br/>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">*Correo</label>
				<div class="col-lg-9">
					<input class="form-control" type="email" id="correo" name="correo" required>
				</div>
				<div class="notify"></div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">*Contraseña</label>
				<div class="col-lg-9">
					<input class="form-control" type="password" id="clave" name="clave" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">*Nombre</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="nombre" name="nombre" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Segundo Nombre</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="2doNombre" name="segundo_nombre">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">*Apellido</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="apellido" name="apellido" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Segundo Apellido</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="2doApellido" name="segundo_apellido">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">*Cédula de Identidad</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="cedula" name="cedula" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">*Fecha de Nacimiento</label>
				<div class="col-lg-9">
					<label class="col-form-label">Formato: YYYY-MM-DD</label>
					<input class="form-control" type="text" id="fechaNac" name="fecha_Nac" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">*Ciudad</label>
				<div class="col-lg-9">
				<select class="form-control" id="ciudades" name="ciudades" required>
					@foreach($ciudades as $ciudad)
						<option value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
					@endforeach
				</select>
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