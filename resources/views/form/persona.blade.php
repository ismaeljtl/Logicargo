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
				<label class="col-lg-3 col-form-label">Correo de Usuario</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="correo" name="correo">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Contraseña</label>
				<div class="col-lg-9">
					<input class="form-control" type="password" id="clave" name="clave">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Nombre</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="nombre" name="nombre">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Segundo Nombre</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="2doNombre" name="segundo_nombre">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Apellido</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="apellido" name="apellido">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Segundo Apellido</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="2doApellido" name="segundo_apellido">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Cédula de Identidad</label>
				<div class="col-lg-9">
					<input class="form-control" type="text" id="cedula" name="cedula">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Fecha de Nacimiento</label>
				<div class="col-lg-9">
					<label class="col-form-label">Formato: YYYY-MM-DD</label>
					<input class="form-control" type="text" id="fechaNac" name="fecha_Nac">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Ciudad</label>
				<div class="col-lg-9">
				<select class="form-control" id="ciudades" name="ciudades">
				</select>
				</div>
			</div>
			<div class="btn-submit" style="text-align:center;">
                <button type="submit" class="btn btn-info" id="businessForm">Enviar</button>
            </div>
			<br/>
			<div class="col-lg-12 regresar">
				<a href="{{url('/')}}">Regresar</a>
			</div>
	    </div>
	    </form>
    </div>

@endsection