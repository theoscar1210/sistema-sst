<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="page-breadcrumb">
                <a href="{{ route('dashboard') }}">Inicio</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                Empleados
            </div>
            <h1 class="page-title">Empleados</h1>
        </div>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Nuevo empleado
        </a>
    </x-slot>

    @if(session('success'))
    <div class="sst-alert sst-alert-success" style="margin-bottom:20px;"
         x-data x-init="setTimeout(() => $el.style.display='none', 4000)">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- Barra de filtros --}}
    <form method="GET" action="{{ route('employees.index') }}" class="filter-bar">
        <div class="search-wrap" style="flex:1;min-width:200px;max-width:280px;">
            <i class="bi bi-search"></i>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Nombre, documento, empresa..."
                class="sst-input"
            >
        </div>
        <input
            type="text"
            name="area"
            value="{{ request('area') }}"
            placeholder="Filtrar por área..."
            class="sst-input"
            style="min-width:140px;max-width:180px;flex:1;"
        >
        <select name="status" class="sst-input" style="min-width:140px;max-width:180px;flex:1;">
            <option value="">Todos los estados</option>
            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Activos</option>
            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactivos</option>
        </select>
        <div style="display:flex;gap:8px;">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-search"></i>
                Buscar
            </button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-x-lg"></i>
                Limpiar
            </a>
        </div>
    </form>

    {{-- Tabla --}}
    <div class="table-card">
        <div class="table-toolbar">
            <div class="table-toolbar-left">
                <span style="font-size:13px;color:var(--text-secondary);">
                    <strong style="color:var(--text-primary);">{{ $employees->total() }}</strong>
                    empleados encontrados
                </span>
                @if(request()->hasAny(['search','area','status']))
                <a href="{{ route('employees.index') }}" class="btn btn-ghost btn-xs" style="color:var(--text-muted);">
                    <i class="bi bi-x"></i>
                    Limpiar filtros
                </a>
                @endif
            </div>
        </div>

        <table class="sst-table">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Documento</th>
                    <th>Área · Cargo</th>
                    <th>Empresa</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:32px;height:32px;border-radius:50%;background:var(--primary-600);color:#fff;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;flex-shrink:0;">
                                {{ strtoupper(substr($employee->full_name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:500;font-size:13.5px;color:var(--text-primary);">
                                    {{ $employee->full_name }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="font-family:monospace;font-size:12.5px;color:var(--text-secondary);letter-spacing:0.02em;">
                            {{ $employee->document_number }}
                        </span>
                    </td>
                    <td>
                        <div style="font-size:13.5px;color:var(--text-primary);">{{ $employee->area }}</div>
                        <div style="font-size:12px;color:var(--text-muted);margin-top:2px;">{{ $employee->position }}</div>
                    </td>
                    <td class="text-muted">{{ $employee->company }}</td>
                    <td>
                        @if($employee->is_active)
                            <span class="badge badge-active">
                                <span class="dot"></span>Activo
                            </span>
                        @else
                            <span class="badge badge-inactive">
                                <span class="dot"></span>Inactivo
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('employees.edit', $employee) }}"
                               class="btn btn-ghost btn-xs"
                               data-tooltip="Editar empleado">
                                <i class="bi bi-pencil"></i>
                                Editar
                            </a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                  onsubmit="return confirm('¿Confirmar eliminación de {{ addslashes($employee->full_name) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-ghost btn-xs"
                                        style="color:var(--danger);"
                                        data-tooltip="Eliminar">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="table-empty">
                            <i class="bi bi-people"></i>
                            <p>No se encontraron empleados.</p>
                            @if(request()->hasAny(['search','area','status']))
                                <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm" style="margin-top:12px;">
                                    Limpiar filtros
                                </a>
                            @else
                                <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm" style="margin-top:12px;">
                                    <i class="bi bi-plus-lg"></i>
                                    Registrar primer empleado
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="table-footer">
            <div class="pagination-wrapper" style="flex:1;">
                {{ $employees->links() }}
            </div>
        </div>
    </div>

</x-app-layout>
