<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="hb btn btn-outline-danger colorRed">
            <i class="fas fa-bars" id="iconHb"></i>
        </button>
        <!-- Drop -->
        <div class="ml-auto">
            <a class="btn btn-outline-danger border-0" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();" id="btn-salir">Cerrar
                sesion <i class="fas fa-sign-out-alt"></i></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            {{-- <button class="btn btn-outline-danger border-0 dropdown-toggle" type="button" id="dropOutCard"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Administracion
                    <i class="fas fa-caret-down"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropOutCard">

                </ul> --}}
        </div>
    </div>
</nav>
