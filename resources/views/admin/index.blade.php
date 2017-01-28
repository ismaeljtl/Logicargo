@extends('layouts.master')

@section('site-section', 'welcome')

@section('header')
@yield('header')

@section('main')

    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1>LOGICARGO</h1>
                        <h3>La empresa donde hacer tus envíos</h3>
                        <hr class="intro-divider">
                        <h2>{{ucwords(Auth::user()->rol)}}</h2>
                        <br/>
                        <div class="col-sm-4">
                            <h3>Reportes</h3>
                        </div>
                        <div class="col-sm-4">
                            <h3>Reportes</h3>
                        </div>
                        <div class="col-sm-4">
                            <h3>Reportes</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection