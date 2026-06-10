<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="page-breadcrumb">
                <a href="{{ route('dashboard') }}">Inicio</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                Certificaciones
            </div>
            <h1 class="page-title">Certificaciones</h1>
        </div>
        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            <a href="{{ route('certifications.export.excel') }}"
                class="btn btn-secondary btn-sm"
                data-tooltip="Exportar a Excel">
                <i class="bi bi-file-earmark-excel" style="color:#16A34A;"></i>
                Excel
            </a>
            <a href="{{ route('certifications.export.pdf') }}"
                class="btn btn-secondary btn-sm"
                data-tooltip="Exportar a PDF">
                <i class="bi bi-file-earmark-pdf" style="color:#DC2626;"></i>
                PDF
            </a>
            <a href="{{ route('certifications.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                Nueva certificación
            </a>
        </div>
    </x-slot>

    @if(session('success'))
    <div class="sst-alert sst-alert-success" style="margin-bottom:20px;"
        x-data x-init="setTimeout(() => $el.style.display='none', 4000)">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- Barra de filtros --}}
    <form method="GET" action="{{ route('certifications.index') }}" class="filter-bar">
        <div class="search-wrap" style="flex:1;min-width:200px;max-width:280px;">
            <i class="bi bi-search"></i>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Nombre o documento del empleado..."
                class="sst-input">
        </div>
        <select name="course_id" class="sst-input" style="min-width:160px;max-width:220px;flex:1;">
            <option value="">Todos los cursos</option>
            @foreach($courses as $course)
            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                {{ $course->name }}
            </option>
            @endforeach
        </select>
        <select name="status" class="sst-input" style="min-width:140px;max-width:180px;flex:1;">
            <option value="">Todos los estados</option>
            <option value="expired" {{ request('status') === 'expired'  ? 'selected' : '' }}>Vencidos</option>
            <option value="expiring" {{ request('status') === 'expiring' ? 'selected' : '' }}>Por vencer</option>
            <option value="active" {{ request('status') === 'active'   ? 'selected' : '' }}>Vigentes</option>
        </select>
        <div style="display:flex;gap:8px;">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-search"></i>
                Buscar
            </button>
            <a href="{{ route('certifications.index') }}" class="btn btn-secondary btn-sm">
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
                    <strong style="color:var(--text-primary);">{{ $certifications->total() }}</strong>
                    certificaciones encontradas
                </span>
                @if(request()->hasAny(['search','course_id','status']))
                <a href="{{ route('certifications.index') }}" class="btn btn-ghost btn-xs" style="color:var(--text-muted);">
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
                    <th>Curso</th>
                    <th>Instituto</th>
                    <th>Emisión</th>
                    <th>Vencimiento</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($certifications as $certification)
                @php $daysLeft = (int) now()->diffInDays($certification->expiry_date, false); @endphp
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:28px;height:28px;border-radius:50%;background:var(--primary-600);color:#fff;display:flex;align-items:center;justify-content:center;font-size:11.5px;font-weight:600;flex-shrink:0;">
                                {{ strtoupper(substr($certification->employee->full_name, 0, 1)) }}
                            </div>
                            <span style="font-weight:500;font-size:13.5px;">
                                {{ $certification->employee->full_name }}
                            </span>
                        </div>
                    </td>
                    <td class="text-muted">{{ $certification->course->name }}</td>
                    <td class="text-muted" style="font-size:13px;">{{ $certification->institute }}</td>
                    <td style="font-size:13px;color:var(--text-secondary);">
                        {{ $certification->issue_date->format('d/m/Y') }}
                    </td>
                    <td>
                        <span style="font-size:13px;{{ $daysLeft < 0 ? 'color:var(--danger);font-weight:500;' : 'color:var(--text-secondary);' }}">
                            {{ $certification->expiry_date->format('d/m/Y') }}
                        </span>
                    </td>
                    <td>
                        @if($daysLeft < 0)
                            <span class="badge badge-expired"><span class="dot"></span>Vencido</span>
                            @elseif($daysLeft <= 30)
                                <span class="badge badge-expiring"><span class="dot"></span>{{ $daysLeft }}d</span>
                                @else
                                <span class="badge badge-vigente"><span class="dot"></span>Vigente</span>
                                @endif
                    </td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('certifications.edit', $certification) }}"
                                class="btn btn-ghost btn-xs"
                                data-tooltip="Editar">
                                <i class="bi bi-pencil"></i>
                                Editar
                            </a>
                            <form action="{{ route('certifications.destroy', $certification) }}"
                                method="POST"
                                onsubmit="return confirm('¿Eliminar esta certificación?')">
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
                    <td colspan="7">
                        <div class="table-empty">
                            <i class="bi bi-award"></i>
                            <p>No se encontraron certificaciones.</p>
                            @if(request()->hasAny(['search','course_id','status']))
                            <a href="{{ route('certifications.index') }}" class="btn btn-secondary btn-sm" style="margin-top:12px;">
                                Limpiar filtros
                            </a>
                            @else
                            <a href="{{ route('certifications.create') }}" class="btn btn-primary btn-sm" style="margin-top:12px;">
                                <i class="bi bi-plus-lg"></i>
                                Nueva certificación
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
                {{ $certifications->links() }}
            </div>
        </div>
    </div>

</x-app-layout>