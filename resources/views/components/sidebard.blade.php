<nav id="sidebar" class="shadow-sm">
    <div class="sidebar-header d-flex justify-content-center">
        <img src="{{ asset('assets/images/logo.png') }}" alt="" width="150" height="150" class="mt-2" />
    </div>

    <ul class="list-unstyled components">
        <li class="py-1">
            <a href="{{ route('/') }}"
                class="btn btn-outline-danger rounded-0 text-start border-0 {{ Request::is('/') ? 'active' : '' }}"><i
                    class="fas fa-home"></i> Inicio
            </a>
        </li>
        {{-- Recursos humanos --}}
        {{-- <li class="py-1">
            <a href="#empresaSubMenu"
                class="btn btn-outline-danger rounded-0 text-start border-0 {{ Request::is('incapacidad') ? 'active' : '' }}"
                data-bs-toggle="collapse" aria-expanded="false" aria-controls="empresaSubMenu">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-users"></i>
                        Recursos Humanos
                    </div>
                    <i class="fas fa-caret-{{ Request::is('incapacidad') ? 'down' : 'left' }}"></i>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ Request::is('incapacidad') ? 'show' : '' }}" id="empresaSubMenu">
                <li class="py-1">
                    <a href="{{ route('incapacidad') }}"
                        class="btn btn-outline-danger rounded-0 text-start border-0 {{ Request::is('incapacidad') ? 'active' : '' }}"
                       ><i class="fas fa-digging"></i> Costo laboral
                    </a>
                </li>
                <li class="py-1">
                    <a href="#" class="btn btn-outline-danger rounded-0 text-start border-0 ">
                        <i class="fas fa-file"></i> Resumen
                    </a>
                </li>
            </ul>
        </li> --}}

        {{-- Incapacidades --}}
        <li class="py-1">
            <a href="#incapacidadesMenu" class="btn btn-outline-danger rounded-0 text-start border-0"
                data-bs-toggle="collapse" aria-expanded="false" aria-controls="incapacidadesMenu">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-heartbeat"></i>
                        Incapacidades
                    </div>
                    <i class="fas fa-caret-{{ Request::is('admin/incapacidad') ? 'down' : 'left' }}"></i>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ Request::is('admin/incapacidad') ? 'show' : '' }}" id="incapacidadesMenu">
                <li class="py-1">
                    <a href="{{ url('admin/incapacidad') }}"
                        class="btn btn-outline-danger rounded-0 text-start border-0 {{ Request::is('admin/incapacidad') ? 'active' : '' }}">
                        <i class="far fa-plus-square"></i> Incapacidad
                    </a>
                </li>
                <li class="py-1">
                    <a href="#" class="btn btn-outline-danger rounded-0 text-start border-0">
                        <i class="fas fa-h-square"></i> Transcripción
                    </a>
                </li>
            </ul>
        </li>

        <li class="py-1">
            <a href="{{ route('empleados') }}" class="btn btn-outline-danger text-start border-0 rounded-0  {{ Request::is('empleados') ? 'active' : '' }}">
                <i class="fas fa-hard-hat"></i> Empleados
            </a>
        </li>

        <li class="py-1">
            <a href="{{ route('usuarios') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ Request::is('usuarios') ? 'active' : '' }} ">
                <i class="fas fa-user-tie"></i> Usuarios
            </a>
        </li>
    </ul>
</nav>
