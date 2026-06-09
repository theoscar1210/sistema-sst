<aside
    class="sst-sidebar"
    :class="{
        'collapsed':    sidebarCollapsed,
        'mobile-open':  mobileOpen
    }"
>
    {{-- Logo --}}
    <div class="sb-logo">
        <div class="sb-logo-mark">S</div>
        <div class="sb-logo-text">
            <div class="sb-logo-name">Sistema SST</div>
            <div class="sb-logo-sub">Seguridad · Salud · Trabajo</div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="sb-nav">

        <div class="sb-section-label">Principal</div>

        <a href="{{ route('dashboard') }}"
           class="sb-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span class="sb-item-text">Dashboard</span>
        </a>

        <div class="sb-section-label">Gestión SST</div>

        <a href="{{ route('employees.index') }}"
           class="sb-item {{ request()->routeIs('employees.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            <span class="sb-item-text">Empleados</span>
        </a>

        <a href="{{ route('courses.index') }}"
           class="sb-item {{ request()->routeIs('courses.*') ? 'active' : '' }}">
            <i class="bi bi-book-fill"></i>
            <span class="sb-item-text">Cursos</span>
        </a>

        <a href="{{ route('certifications.index') }}"
           class="sb-item {{ request()->routeIs('certifications.*') ? 'active' : '' }}">
            <i class="bi bi-award-fill"></i>
            <span class="sb-item-text">Certificaciones</span>
        </a>

        @if(auth()->user()->role === 'super_admin')
        <div class="sb-section-label">Administración</div>

        <a href="{{ route('users.index') }}"
           class="sb-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <i class="bi bi-person-fill-gear"></i>
            <span class="sb-item-text">Usuarios</span>
        </a>

        <a href="{{ route('activity_logs.index') }}"
           class="sb-item {{ request()->routeIs('activity_logs.*') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i>
            <span class="sb-item-text">Historial</span>
        </a>
        @endif

    </nav>

    {{-- Footer: usuario --}}
    <div class="sb-footer" x-data="{ userMenuOpen: false }">
        <div class="relative">
            <button
                @click="userMenuOpen = !userMenuOpen"
                @click.outside="userMenuOpen = false"
                class="sb-user"
            >
                <div class="sb-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="sb-user-info">
                    <div class="sb-user-name">
                        {{ auth()->user()->name }} {{ auth()->user()->last_name ?? '' }}
                    </div>
                    <div class="sb-user-role">
                        {{ auth()->user()->role === 'super_admin' ? 'Super Admin' : 'Usuario SST' }}
                    </div>
                </div>
                <i class="bi bi-three-dots flex-shrink-0 text-xs"
                   style="color:#475569; transition: opacity 0.18s;"
                   :style="sidebarCollapsed ? 'opacity:0;width:0;overflow:hidden' : 'opacity:1'"
                ></i>
            </button>

            {{-- User dropdown (abre hacia arriba) --}}
            <div
                x-show="userMenuOpen"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute bottom-full left-0 mb-2 sst-dropdown"
                style="min-width:210px; display:none;"
                @click="userMenuOpen = false"
            >
                <div class="sst-dropdown-header">
                    <div style="font-size:13px;font-weight:600;color:#0F172A;">
                        {{ auth()->user()->name }} {{ auth()->user()->last_name ?? '' }}
                    </div>
                    <div style="font-size:11.5px;color:#64748B;margin-top:2px;">
                        {{ auth()->user()->email }}
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}" class="sst-dropdown-item">
                    <i class="bi bi-person"></i>
                    Mi perfil
                </a>
                <div class="sst-dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sst-dropdown-item danger" style="width:100%">
                        <i class="bi bi-box-arrow-left"></i>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>

</aside>
