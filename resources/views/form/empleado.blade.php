@extends('layouts.master')

@section('site-section', 'register-empleado')

@section('main')

    <div class="container-horizontal">
		<form class="form-group" method="POST" action="createEmpleado">
		{{ csrf_field() }}
		<!-- El offset en la columna hace que se desplace la cantidad indicada de columnas hacia la derecha -->
		<div class="col-sm-4 col-sm-offset-4">
	        <h2>Registro de Empleado</h2>
	        <br/>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">*Correo</label>
				<div class="col-lg-9 divCorreo">
					<input class="form-control" type="text" id="correo" name="correo" required>
				</div>
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
					<input class="form-control" type="text" id="segundo_nombre" name="segundo_nombre">
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
					<input class="form-control" type="text" id="segundo_apellido" name="segundo_apellido">
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
					<input class="form-control" type="text" id="fecha_Nac" name="fecha_Nac" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">*Fecha de Inicio</label>
				<div class="col-lg-9">
					<label class="col-form-label">Formato: YYYY-MM-DD</label>
					<input class="form-control" type="text" id="fecha_Inic" name="fecha_Inic" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">*Centro de Distibución</label>
				<div class="col-lg-9">
					<select class="form-control" id="centro_Dist" name="centro_Dist" required>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-form-label">*Cargo</label>
				<div class="col-lg-9">
					<select class="form-control" id="tipoEmp" name="tipoEmp" required>
						<option value="1">Jefe de Repartidores</option>
						<option value="2">Repartidor</option>
						<option value="3">Secretaria</option>
						<option value="4">Ingeniero de Soporte</option>
						<option value="5">Gerente</option>
					</select>
				</div>
			</div>
			<div class="form-group row" id="jefe" name="jefe" style="display: none;">
				<label class="col-lg-3 col-form-label">Id Jefe</label>
				<div class="col-lg-9">
					<select class="form-control" id="Jefe_id" name="Jefe_id">
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