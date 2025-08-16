<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <a class="nav-link" href="{{ route('clients.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users-line"></i></div>
                    Clientes
                </a>

                <a class="nav-link" href="{{ route('tasks.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list-check"></i></div>
                    Tareas
                </a>

                <a class="nav-link" href="{{ route('calendar') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                    Calendario
                </a>

                <div class="sb-sidenav-menu-heading">Administración</div>

                <a class="nav-link" href="{{ route('settings.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>
                    Configuración
                </a>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>