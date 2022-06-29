<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="hb btn btn-outline-danger colorRed">
            <i class="fas fa-bars" id="iconHb"></i>
        </button>
        <!-- Drop -->
        <div class="div d-flex justify-content-end g-3 align-items-center">
            <img src="{{ asset('assets/images/builder.png') }}" alt="" class="avatar" />
            <div class="dropdown px-1">
                <button class="btn btn-outline-danger border-0 dropdown-toggle" type="button" id="dropOutCard"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Administracion
                    <i class="fas fa-caret-down"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropOutCard">
                    <li>
                        <a class="dropdown-item text-danger text-white" href="#" id="btn-salir">Cerrar
                            sesion <i class="fas fa-sign-out-alt"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
