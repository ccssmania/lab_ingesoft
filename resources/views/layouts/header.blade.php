@section('header')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                </li>
                @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('course.index') }}">Niveles Disponibles</a>
                </li>
                @endif
                @if (Auth::check() && Auth::user()->role()->first()->name == "Admin")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Peticiones de Inscripcion</a>
                    </li>
                @endif
                @if (Auth::check() && Auth::user()->role()->first()->name == "Admin")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('examen.index') }}"> Crear examen</a>
                    </li>
                @else
                    @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('examen.index') }}">Realizar Examen</a>
                        </li>
                    @endif
                @endif
                @if (Auth::check() && Auth::user()->role()->first()->name == "Admin")
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">Usuarios</a>
                    </li>
                @endif 
                @if (Auth::check())
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.account', [Auth::id()]) }}">Informacion de cuenta</a>
                    </li>
                @endif
                @if (Auth::check())
                    <li class="nav-item">
                            <a class="nav-link" href="{{ url('/logros') }}">Logros</a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href=" {{ route('login') }}">Ingresar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=" {{ route('register') }}">Registrar</a>
                    </li>
                @else
                    <li class="nav-item">
                        {{-- {!! Form::open(["method" => "post", "action" =>  route('logout') ]) !!} --}}
                        {{-- <a class="nav-link" href=" {{ route('logout') }}">Logout</a> --}}
                        {{-- {!! Form::submit('Logout', ['class' => 'nav-link', 'id' => 'logoutbutton']) !!} --}}
                        {{-- {!! Form::close() !!} --}}
                                <a class="nav-link" id="logoutbutton" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logoutform').submit();">
                                    Salir
                                </a>
                                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>