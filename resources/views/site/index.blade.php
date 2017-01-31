@extends('layouts.master')

@section('site-section', 'welcome')

@section('main')

    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>
                            LOGICARGO
                            @if(session()->has('centro_distribucion')) 
                            - {{strtoupper(session()->get('centro_distribucion'))}} 
                            @endif
                        </h1>
                        <h3>La empresa donde hacer tus envíos</h3>
                        <hr class="intro-divider">
                        @if(Auth::check())
                            @if(strcmp(Auth::user()->rol,'empleado')==0)
                                <h2>{{ucwords(session()->get('tipo_empleado_tipo'))}}</h2>
                            @else
                                <h2>{{ucwords(Auth::user()->rol)}}</h2>
                            @endif
                            <br/>
                            @if(strcmp(Auth::user()->rol,'admin')==0)
                                @include('admin.opciones_index')
                            @endif
                        @else
                            <br/><br/>
                            <h4>¿Aún no estás registrado?</h4>
                            <h4>Registrate ya!</h4>
                            <ul class="list-inline intro-social-buttons">
                                <li>
                                    <a href="formPersona" class="btn btn-info btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Persona Natural</span></a>
                                </li>
                                <li>
                                    <a href="formEmpleado" class="btn btn-info btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Empleado</span></a>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection