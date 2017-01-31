<nav class="navbar navbar-default" role="navigation">
    <div class="container topnav">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand topnav" href="{{url('/')}}">
                LOGICARGO 
                @if(session()->has('centro distribucion')) 
                    - {{strtoupper(session()->get('centro distribucion'))}} 
                @endif
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <form class="form-group" method="POST" action="Login">
            {{ csrf_field() }}
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{url('/nuevo_envio')}}">Realiza un envío</a>
                </li>                
                <li>
                    <a class="name-perfil">{{ Auth::user()->user }}</a>
                </li>
                <li>

                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle btn-circle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="glyphicon glyphicon-option-vertical"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            @if(strcmp(Auth::user()->user, 'admin') == 0)
                                <li><a href="{{ url('Logout') }}">Salir de Aplicación</a></li>
                            @else
                                <li><a href="actualizarCliente">Editar Datos</a></li>
                                <li><a href="{{ url('Logout') }}">Salir de Aplicación</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a id="eliminar" onclick="eliminarCli()">Eliminar Cuenta</a></li>
                            @endif
                        </ul>
                    </div>
                </li>
            </ul>
        </form>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>