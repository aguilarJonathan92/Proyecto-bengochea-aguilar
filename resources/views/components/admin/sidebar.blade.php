<aside class="admin-sidebar shadow-ui d-flex flex-column">
    <button id="toggleSidebar" class="btn-toggle-custom">
        <i class="fas fa-chevron-left" id="toggleIcon"></i>
    </button>

    <div class="logo-container text-center py-4 position-relative border-bottom">
        <div class="logo-auth">
            <span class="logo-soundwave">
                S<span class="logo-extra">OUNDWAVE</span>
            </span>
            <span class="logo-store">
                S<span class="logo-extra">TORE</span>
            </span>
        </div>
        <small class="text-muted-adaptativo d-block mt-1 logo-text">Panel de Control</small>
    </div>
    <nav class="sidebar-nav grow mt-2">
    <ul class="list-unstyled">
        {{-- Botón Principal / Dashboard --}}
        <li class="nav-item">
            <a href="#" class="sidebar-link active">
                <i class="fas fa-th-large"></i>
                <span class="link-text">Principal</span>
            </a>
        </li>

        {{-- Productos --}}
        <li class="nav-item">
            <a href="#" class="sidebar-link">
                <i class="fas fa-box"></i>
                <span class="link-text">Productos</span>
            </a>
        </li>

        {{-- Usuarios --}}
        <li class="nav-item">
            <a href="#" class="sidebar-link">
                <i class="fas fa-users"></i>
                <span class="link-text">Usuarios</span>
            </a>
        </li>

        {{-- Ventas --}}
        <li class="nav-item">
            <a href="#" class="sidebar-link">
                <i class="fas fa-shopping-cart"></i>
                <span class="link-text">Ventas</span>
            </a>
        </li>

        {{-- Consultas --}}
        <li class="nav-item">
            <a href="#" class="sidebar-link">
                <i class="fas fa-comment-dots"></i>
                <span class="link-text">Consultas</span>
            </a>
        </li>
    </ul>
</nav>
{{-- Bloque de Usuario y Logout al final --}}
<div class="sidebar-user-footer mt-auto border-top-ui">
    
    {{-- Tarjeta de Usuario --}}
    <div class="user-card d-flex align-items-center p-3">
        <div class="user-avatar-wrapper">
            <img src="https://ui-avatars.com/api/?name=Javier+Garcia&background=d4a017&color=1a1a1a" 
                 alt="Avatar" class="user-avatar shadow-sm">
        </div>
        <div class="user-info ms-3">
            <span class="d-block fw-bold color-texto user-name">Javier Garcia</span>
            <small class="text-muted-adaptativo user-role">SuperAdmin</small>
        </div>
    </div>

    {{-- Botón Logout --}}
    <div class="p-3 pt-0">
        <form>  {{-- method="POST" action="{{ route('logout') }}" --}}
            @csrf
            <button type="submit" class="btn-logout-sidebar" title="Cerrar Sesión">
                <i class="fas fa-sign-out-alt"></i>
                <span class="logout-text ms-2">Cerrar Sesión</span>
            </button>
        </form>
    </div>
</div>
</aside>