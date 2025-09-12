<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">CRM</div>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                @permission('clientes')
                <a class="nav-link" href="{{ route('clients.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users-line"></i></div>
                    Clientes
                </a>
                @endpermission

                @permission('tareas')
                <a class="nav-link" href="{{ route('tasks.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list-check"></i></div>
                    Tareas
                </a>
                @endpermission

                @permission('calendario')
                <a class="nav-link" href="{{ route('calendar') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                    Calendario
                </a>
                @endpermission

                <div class="sb-sidenav-menu-heading">Administración</div>

                @permission('configuracion')
                <a class="nav-link" href="{{ route('settings.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                    Configuración
                </a>
                @endpermission

                @permission('usuarios')
                <a class="nav-link" href="{{ route('users.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users-gear"></i></div>
                    Usuarios
                </a>
                @endpermission

                @permission('permisos')
                <a class="nav-link" href="{{ route('permissions.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-shield"></i></div>
                    Permisos
                </a>
                @endpermission

            </div>
        </div>
    </nav>
</div>