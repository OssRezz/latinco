<nav id="sidebar" class="shadow-sm">
    <div class="sidebar-header d-flex justify-content-center">
        <img src="{{ asset('assets/images/logo.png') }}" alt="" width="150" height="150" class="mt-2" />
    </div>

    <ul class="list-unstyled components">
        <li class="py-1">
            <a href="{{ route('/') }}"
                class="btn btn-outline-danger rounded-0 text-start border-0 {{ Request::is('/') ? 'active' : '' }}">
                <i class="bi bi-building fa-xl" style="height: 26px !important;width: 26px !important;"></i>
                Inicio
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
        {{-- Flujo de caja --}}
        <li class="py-1">
            <a href="#flujoDeCaja" class="btn btn-outline-danger rounded-0 text-start border-0"
                data-bs-toggle="collapse" aria-expanded="false" aria-controls="flujoDeCaja">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-cash-register fa-xl"></i>
                        Flujo de caja
                    </div>
                    <i class="fas fa-caret-{{ Request::is('') || Request::is('') ? 'down' : 'left' }}  "></i>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ Request::is('') || Request::is('') ? 'show' : '' }}"
                id="flujoDeCaja">
                <li class="py-1">
                    <a href="{{ url('admin/incapacidad') }}"
                        class="btn btn-outline-danger rounded-0 text-start border-0 {{ Request::is('') ? 'active' : '' }}">
                        <i class="fas fa-box-open fa-xl"></i> Proveedores
                    </a>
                </li>
            </ul>
        </li>

        {{-- Costo laboral --}}
        <li class="py-1">
            <a href="#costoLaboralMenu" class="btn btn-outline-danger rounded-0 text-start border-0"
                data-bs-toggle="collapse" aria-expanded="false" aria-controls="costoLaboralMenu">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-file-invoice-dollar fa-xl"></i>
                        Costo laboral
                    </div>
                    <i class="fas fa-caret-{{ Request::is('') || Request::is('') ? 'down' : 'left' }}  "></i>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ Request::is('') || Request::is('') ? 'show' : '' }}"
                id="costoLaboralMenu">
                <li class="py-1">
                    <a href="{{ url('') }}"
                        class="btn btn-outline-danger rounded-0 text-start border-0 {{ Request::is('') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list fa-xl"></i> Conceptos
                    </a>
                </li>
                <li class="py-1">
                    <a href="{{ url('') }}"
                        class="btn btn-outline-danger rounded-0 text-start border-0 {{ Request::is('') ? 'active' : '' }}">
                        <i class="fas fa-user-shield fa-xl"></i> Responsables
                    </a>
                </li>
            </ul>
        </li>
        {{-- Incapacidad --}}
        <li class="py-1">
            <a href="#incapacidadesMenu" class="btn btn-outline-danger rounded-0 text-start border-0"
                data-bs-toggle="collapse" aria-expanded="false" aria-controls="incapacidadesMenu">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-user-injured fa-xl"></i>
                        Incapacidades
                    </div>
                    <i
                        class="fas fa-caret-{{ Request::is('admin/incapacidad') || Request::is('admin/incapacidades') ? 'down' : 'left' }}  "></i>
                </div>
            </a>
            <ul class="collapse list-unstyled {{ Request::is('admin/incapacidad') || Request::is('admin/incapacidades') ? 'show' : '' }}"
                id="incapacidadesMenu">
                <li class="py-1">
                    <a href="{{ url('admin/incapacidad') }}"
                        class="btn btn-outline-danger rounded-0 text-start border-0 {{ Request::is('admin/incapacidad') ? 'active' : '' }}">
                        <i class="far fa-plus-square fa-xl"></i> Incapacidad
                    </a>
                </li>
                <li class="py-1">
                    <a href="{{ url('admin/incapacidades') }}"
                        class="btn btn-outline-danger rounded-0 text-start border-0 {{ Request::is('admin/incapacidades') ? 'active' : '' }}">
                        <i class="fas fa-h-square fa-xl"></i> Incapacidades registradas
                    </a>
                </li>
            </ul>
        </li>

        <li class="py-1">
            <a href="{{ route('empleados') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0  {{ Request::is('empleados') ? 'active' : '' }}">
                <i class="fas fa-hard-hat fa-xl"></i> Empleados
            </a>
        </li>

        <li class="py-1">
            <a href="{{ route('admin.usuario.index') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ request()->is('admin/usuario') || request()->is('admin/usuario/*') ? 'active' : '' }} ">
                <i class="fas fa-user-tie fa-xl"></i> Usuarios
            </a>
        </li>
        <li class="py-1">
            <a href="{{ route('admin.compania.index') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ request()->is('admin/compania') || request()->is('admin/compania/*') ? 'active' : '' }}">
                <i class="fa-solid fa-industry fa-xl"></i> Compañia
            </a>
        </li>
        <li class="py-1">
            <a href="{{ route('admin.co.index') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ request()->is('admin/co') || request()->is('admin/co/*') ? 'active' : '' }}">
                <i class="fas fa-info-circle fa-xl"></i> CO
            </a>
        </li>
    </ul>
</nav>
