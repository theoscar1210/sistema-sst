<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="page-breadcrumb">
                <a href="{{ route('dashboard') }}">Inicio</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                Cursos
            </div>
            <h1 class="page-title">Cursos</h1>
        </div>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Nuevo curso
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
    <form method="GET" action="{{ route('courses.index') }}" class="filter-bar">
        <div class="search-wrap" style="flex:1;min-width:200px;max-width:400px;">
            <i class="bi bi-search"></i>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Buscar curso por nombre o descripción..."
                class="sst-input"
            >
        </div>
        <div style="display:flex;gap:8px;">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-search"></i>
                Buscar
            </button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-sm">
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
                    <strong style="color:var(--text-primary);">{{ $courses->total() }}</strong>
                    cursos registrados
                </span>
            </div>
        </div>

        <table class="sst-table">
            <thead>
                <tr>
                    <th>Nombre del curso</th>
                    <th>Vigencia</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:32px;height:32px;border-radius:var(--r-md);background:#FFF7ED;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="bi bi-book-fill" style="color:#F97316;font-size:14px;"></i>
                            </div>
                            <span style="font-weight:500;font-size:13.5px;color:var(--text-primary);">{{ $course->name }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-info" style="background:#EFF6FF;color:#1E40AF;border-color:#BFDBFE;">
                            <i class="bi bi-clock" style="font-size:10px;"></i>
                            {{ $course->validity_months }} mes{{ $course->validity_months !== 1 ? 'es' : '' }}
                        </span>
                    </td>
                    <td class="text-muted" style="max-width:280px;">
                        <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:block;">
                            {{ $course->description ?? '—' }}
                        </span>
                    </td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('courses.edit', $course) }}"
                               class="btn btn-ghost btn-xs"
                               data-tooltip="Editar curso">
                                <i class="bi bi-pencil"></i>
                                Editar
                            </a>
                            <form action="{{ route('courses.destroy', $course) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar el curso {{ addslashes($course->name) }}?')">
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
                    <td colspan="4">
                        <div class="table-empty">
                            <i class="bi bi-book"></i>
                            <p>No se encontraron cursos.</p>
                            <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm" style="margin-top:12px;">
                                <i class="bi bi-plus-lg"></i>
                                Crear primer curso
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="table-footer">
            <div class="pagination-wrapper" style="flex:1;">
                {{ $courses->links() }}
            </div>
        </div>
    </div>

</x-app-layout>
