<nav class="nav-index navbar navbar-expand-md navbar-dark bg-dark shadow-sm fixed-top py-0">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img style="max-width: 50px" src="{{ asset('assets/logo/logo_contador.png') }}" alt="">
            ApppContador
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">INGRESAR</a>
                    </li>
                @else
                    @if (Route::has('home'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Ir al app</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                                CERRAR SESION
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <a class="dropdown-item" href="{{ asset('assets/files/templatemayorcompra.xlsx') }}"
                               ><i class="fas fa-sign-out-alt"></i>
                               PLANTILLA COMPRAS
                            </a>

                            <a class="dropdown-item" href="{{ asset('assets/files/templatemayorventa.xlsx') }}"
                               ><i class="fas fa-sign-out-alt"></i>
                               PLANTILLA VENTAS
                            </a>

                            <a class="dropdown-item" href="{{ asset('assets/files/templatemayorgasto.xlsx') }}"
                               ><i class="fas fa-sign-out-alt"></i>
                               PLANTILLA GASTOS
                            </a>

                            <a class="dropdown-item" href="{{ asset('assets/files/templateactivos.xlsx') }}"
                               ><i class="fas fa-sign-out-alt"></i>
                               PLANTILLA ACTIVOS FIJOS
                            </a>
                            
                            <a class="dropdown-item" id="seguimiento-btn" onclick="getview('#content','/Seguimiento',confirmacion)">
                                <i class="fas fa-microscope"></i> SEGUIMIENTO
                            </a>
                            <a class="dropdown-item" id="datauser-btn" onclick="getview('#content','/Userdata',confirmacion)">
                                <i class="fas fa-address-card"></i> USUARIO
                            </a>
                            <a class="dropdown-item" id="admin-btn" onclick="getview('#content','/Admin',confirmacion)">
                                <i class="fas fa-user-tie"></i> ADMIN
                            </a>
                        </div>
                    </li>
                    
                @endguest
            </ul>
        </div>
    </div>
</nav>
