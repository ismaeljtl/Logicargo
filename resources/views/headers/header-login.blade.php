<nav class="navbar navbar-default" role="navigation">
    <div class="container topnav">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand topnav" href="{{url('/')}}">LOGICARGO</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <form class="form-group" method="POST" action="Login">
            {{ csrf_field() }}
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <input type="text" class="form-control" name="user" placeholder="Correo de Usuario">
                </li>
                <li>
                    <input type="password" class="form-control" name="password" placeholder="Contraseña">
                </li>
                <li>
                    <button type="submit" class="btn btn-info">Entrar</button>
                </li>
            </ul>
        </form>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>