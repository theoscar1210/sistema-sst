<header class="sst-topbar">

    {{-- Izquierda: toggle sidebar --}}
    <div class="tb-left">
        {{-- Desktop: colapsar/expandir sidebar --}}
        <button
            @click="sidebarCollapsed = !sidebarCollapsed"
            class="tb-collapse-btn hidden md:flex"
            :title="sidebarCollapsed ? 'Expandir menú' : 'Colapsar menú'"
        >
            <i class="bi" :class="sidebarCollapsed ? 'bi-layout-sidebar-reverse' : 'bi-layout-sidebar'"></i>
        </button>

        {{-- Móvil: abrir sidebar --}}
        <button
            @click="mobileOpen = !mobileOpen"
            class="tb-collapse-btn flex md:hidden"
        >
            <i class="bi bi-list"></i>
        </button>

        {{-- Search (desktop) --}}
        <div class="tb-search hidden sm:flex">
            <i class="bi bi-search"></i>
            <input
                type="text"
                placeholder="Buscar empleados, certificaciones..."
                onkeydown="if(event.key==='Enter' && this.value.trim()){window.location.href='{{ route('employees.index') }}?search='+encodeURIComponent(this.value.trim())}"
            >
        </div>
    </div>

    {{-- Derecha: acciones --}}
    <div class="tb-actions">

        @php
            try {
                $expiredCount = \App\Models\Certification::where('expiry_date', '<', now())->count();
            } catch (\Exception $e) {
                $expiredCount = 0;
            }
        @endphp

        {{-- Notificaciones --}}
        <a
            href="{{ route('certifications.index') }}?status=expired"
            class="tb-icon-btn"
            data-tooltip="{{ $expiredCount > 0 ? $expiredCount.' certificaciones vencidas' : 'Sin alertas' }}"
        >
            <i class="bi bi-bell"></i>
            @if($expiredCount > 0)
                <span class="tb-notif-badge">
                    {{ $expiredCount > 9 ? '9+' : $expiredCount }}
                </span>
            @endif
        </a>

        {{-- Configuración --}}
        <a href="{{ route('profile.edit') }}" class="tb-icon-btn" data-tooltip="Mi perfil">
            <i class="bi bi-gear"></i>
        </a>

        <div class="tb-divider"></div>

        {{-- Usuario --}}
        <div x-data="{ open: false }" class="relative" @click.outside="open = false">
            <button @click="open = !open" class="tb-user">
                <div class="tb-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span class="tb-username hidden md:block">
                    {{ auth()->user()->name }}
                </span>
                <i class="bi bi-chevron-down hidden md:block"
                   style="font-size:11px; color:#94A3B8;"
                   :style="open ? 'transform:rotate(180deg)' : ''"
                   class="transition-transform"></i>
            </button>

            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 top-full mt-2 sst-dropdown"
                style="min-width:210px; display:none; transform-origin:top right;"
                @click="open = false"
            >
                <div class="sst-dropdown-header">
                    <div style="font-size:13px;font-weight:600;color:#0F172A;">
                        {{ auth()->user()->name }} {{ auth()->user()->last_name ?? '' }}
                    </div>
                    <div style="font-size:11.5px;color:#64748B;margin-top:2px;">
                        {{ auth()->user()->role === 'super_admin' ? 'Super Administrador' : 'Usuario SST' }}
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
</header>
