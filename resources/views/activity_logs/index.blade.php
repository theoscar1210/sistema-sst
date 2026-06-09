<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="page-breadcrumb">
                <a href="{{ route('dashboard') }}">Inicio</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                Historial
            </div>
            <h1 class="page-title">Historial de actividad</h1>
        </div>
        <div style="display:flex;align-items:center;gap:8px;">
            <span style="font-size:12px;color:var(--text-muted);">
                <i class="bi bi-shield-lock" style="color:var(--primary-500);"></i>
                Solo lectura
            </span>
        </div>
    </x-slot>

    <div class="table-card">
        <div class="table-toolbar">
            <div class="table-toolbar-left">
                <span style="font-size:13px;color:var(--text-secondary);">
                    Registro completo de acciones realizadas en el sistema
                </span>
            </div>
        </div>

        <table class="sst-table">
            <thead>
                <tr>
                    <th>Fecha y hora</th>
                    <th>Usuario</th>
                    <th>Acción</th>
                    <th>Módulo</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td>
                        <div style="font-size:12.5px;color:var(--text-secondary);white-space:nowrap;">
                            <div style="font-weight:500;color:var(--text-primary);">
                                {{ $log->created_at->format('d/m/Y') }}
                            </div>
                            <div style="font-size:11.5px;color:var(--text-muted);">
                                {{ $log->created_at->format('H:i') }}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <div style="width:26px;height:26px;border-radius:50%;background:var(--primary-600);color:#fff;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:600;flex-shrink:0;">
                                {{ strtoupper(substr($log->user->name, 0, 1)) }}
                            </div>
                            <span style="font-size:13.5px;font-weight:500;color:var(--text-primary);">
                                {{ $log->user->name }} {{ $log->user->last_name }}
                            </span>
                        </div>
                    </td>
                    <td>
                        @if($log->action === 'created')
                            <span class="badge badge-vigente"><span class="dot"></span>Creó</span>
                        @elseif($log->action === 'updated')
                            <span class="badge badge-expiring"><span class="dot"></span>Actualizó</span>
                        @elseif($log->action === 'deleted')
                            <span class="badge badge-expired"><span class="dot"></span>Eliminó</span>
                        @else
                            <span class="badge badge-pending"><span class="dot"></span>{{ $log->action }}</span>
                        @endif
                    </td>
                    <td>
                        <span style="font-size:12px;font-family:monospace;background:var(--bg-surface2);padding:2px 8px;border-radius:var(--r);color:var(--text-secondary);">
                            {{ class_basename($log->model_type ?? '—') }}
                        </span>
                    </td>
                    <td class="text-muted" style="font-size:13px;max-width:320px;">
                        <span style="overflow:hidden;text-overflow:ellipsis;display:block;white-space:nowrap;">
                            {{ $log->description }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="table-empty">
                            <i class="bi bi-clock-history"></i>
                            <p>No hay actividad registrada aún.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="table-footer">
            <div class="pagination-wrapper" style="flex:1;">
                {{ $logs->links() }}
            </div>
        </div>
    </div>

</x-app-layout>
