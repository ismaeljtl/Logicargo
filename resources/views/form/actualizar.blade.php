@extends('layouts.master')

@section('site-section', 'register-persona')

@section('main')

    <div class="container-horizontal">
		<form class="form-group" method="POST" action="createPersona">
		{{ csrf_field() }}
		<!-- El offset en la columna hace que se desplace la cantidad indicada de columnas hacia la derecha -->
		<div class="col-sm-4 col-sm-offset-4">
	        <h2>Actualización de Datos</h2>
			<br/>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Correo de Usuario</label>
				<div class="col-lg-9">
					<input class="form-control" type="email" id="correo" name="correo" value="{{$usuario[0]->nombre}}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Antigua Contraseña</label>
				<div class="col-lg-9">
					<input class="form-control" type="password" id="clave" name="clave">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Nueva Contraseña</label>
				<div class="col-lg-9">
					<input class="form-control" type="password" id="clave" name="clave">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">Repita la Contraseña</label>
				<div class="col-lg-9">
					<input class="form-control" type="password" id="clave" name="clave">
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