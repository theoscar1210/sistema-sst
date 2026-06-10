<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="page-breadcrumb">
                <i class="bi bi-house" style="font-size:11px;"></i>
                Inicio
            </div>
            <h1 class="page-title">Dashboard</h1>
        </div>
        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
            <a href="{{ route('certifications.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i>
                Nueva certificación
            </a>
            <a href="{{ route('employees.create') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-person-plus"></i>
                Nuevo empleado
            </a>
        </div>
    </x-slot>

    {{-- Alertas críticas --}}
    @if($expired > 0)
    <div class="sst-alert sst-alert-danger" style="margin-bottom:20px;">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div>
            <strong>Atención crítica:</strong>
            {{ $expired }} certificación{{ $expired !== 1 ? 'es' : '' }} ha{{ $expired !== 1 ? 'n' : '' }} vencido.
            <a href="{{ route('certifications.index') }}?status=expired"
                style="font-weight:600;text-decoration:underline;margin-left:6px;">
                Ver ahora →
            </a>
        </div>
    </div>
    @endif

    @if($expiringSoon > 0 && $expired === 0)
    <div class="sst-alert sst-alert-warning" style="margin-bottom:20px;">
        <i class="bi bi-clock-fill"></i>
        <div>
            <strong>Por vencer:</strong>
            {{ $expiringSoon }} certificación{{ $expiringSoon !== 1 ? 'es' : '' }}
            vence{{ $expiringSoon !== 1 ? 'n' : '' }} en los próximos 30 días.
            <a href="{{ route('certifications.index') }}?status=expiring"
                style="font-weight:600;text-decoration:underline;margin-left:6px;">
                Revisar →
            </a>
        </div>
    </div>
    @endif

    {{-- KPI Cards --}}
    <div class="kpi-grid">

        {{-- Total empleados --}}
        <div class="kpi-card">
            <div class="kpi-icon-wrap" style="background:#EEF3FF;">
                <i class="bi bi-people-fill" style="color:#4A55E8;"></i>
            </div>
            <div>
                <div class="kpi-value">{{ $totalEmployees }}</div>
                <div class="kpi-label">Total empleados</div>
                <a href="{{ route('employees.index') }}" class="kpi-trend" style="color:var(--primary-600);">
                    Ver todos <i class="bi bi-arrow-right" style="font-size:10px;"></i>
                </a>
            </div>
        </div>

        {{-- Vigentes --}}
        <div class="kpi-card">
            <div class="kpi-icon-wrap" style="background:#ECFDF5;">
                <i class="bi bi-shield-fill-check" style="color:#10B981;"></i>
            </div>
            <div>
                <div class="kpi-value" style="color:#065F46;">{{ $active }}</div>
                <div class="kpi-label">Certificaciones vigentes</div>
                <span class="kpi-trend up">
                    <i class="bi bi-check-circle-fill" style="font-size:10px;"></i>
                    Al día
                </span>
            </div>
        </div>

        {{-- Por vencer --}}
        <div class="kpi-card">
            <div class="kpi-icon-wrap" style="background:#FFFBEB;">
                <i class="bi bi-clock-fill" style="color:#F59E0B;"></i>
            </div>
            <div>
                <div class="kpi-value" style="color:#78350F;">{{ $expiringSoon }}</div>
                <div class="kpi-label">Por vencer (30 días)</div>
                <a href="{{ route('certifications.index') }}?status=expiring" class="kpi-trend" style="color:#F59E0B;">
                    Revisar <i class="bi bi-arrow-right" style="font-size:10px;"></i>
                </a>
            </div>
        </div>

        {{-- Vencidas --}}
        <div class="kpi-card {{ $expired > 0 ? 'kpi-card--alert' : '' }}">
            <div class="kpi-icon-wrap" style="background:#FEF2F2;">
                <i class="bi bi-exclamation-triangle-fill" style="color:#EF4444;"></i>
            </div>
            <div>
                <div class="kpi-value" style="color:#991B1B;">{{ $expired }}</div>
                <div class="kpi-label">Certificaciones vencidas</div>
                @if($expired > 0)
                <a href="{{ route('certifications.index') }}?status=expired" class="kpi-trend down">
                    <i class="bi bi-arrow-right" style="font-size:10px;"></i>
                    Atender ahora
                </a>
                @else
                <span class="kpi-trend up">
                    <i class="bi bi-check-circle-fill" style="font-size:10px;"></i>
                    Sin vencidas
                </span>
                @endif
            </div>
        </div>

    </div>

    {{-- Grid principal --}}
    <div class="dash-grid">

        {{-- Tabla próximas a vencer --}}
        <div class="table-card">
            <div class="table-toolbar">
                <div class="table-toolbar-left">
                    <div>
                        <div style="font-size:13.5px;font-weight:600;color:var(--text-primary);">
                            Próximas a vencer
                        </div>
                        <div style="font-size:12px;color:var(--text-muted);margin-top:2px;">
                            Certificaciones con vencimiento en los próximos 30 días
                        </div>
                    </div>
                </div>
                <div class="table-toolbar-right">
                    <a href="{{ route('certifications.index') }}" class="btn btn-secondary btn-sm">
                        Ver todas
                        <i class="bi bi-arrow-right" style="font-size:10px;"></i>
                    </a>
                </div>
            </div>

            @if($recentExpiring->isEmpty())
            <div class="table-empty">
                <i class="bi bi-shield-fill-check"></i>
                <p>No hay certificaciones próximas a vencer.</p>
                <p style="color:var(--success);font-weight:600;margin-top:4px;">¡Todo está al día!</p>
            </div>
            @else
            <table class="sst-table">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Curso</th>
                        <th>Vencimiento</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentExpiring as $cert)
                    @php $daysLeft = (int) now()->diffInDays($cert->expiry_date, false); @endphp
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:28px;height:28px;border-radius:50%;background:var(--primary-600);color:#fff;display:flex;align-items:center;justify-content:center;font-size:11.5px;font-weight:600;flex-shrink:0;">
                                    {{ strtoupper(substr($cert->employee->full_name, 0, 1)) }}
                                </div>
                                <span style="font-weight:500;font-size:13.5px;">{{ $cert->employee->full_name }}</span>
                            </div>
                        </td>
                        <td class="text-muted">{{ $cert->course->name }}</td>
                        <td class="text-muted" style="font-size:13px;">{{ $cert->expiry_date->format('d/m/Y') }}</td>
                        <td>
                            @if($daysLeft <= 7)
                                <span class="badge badge-expired"><span class="dot"></span>{{ $daysLeft }}d</span>
                                @else
                                <span class="badge badge-expiring"><span class="dot"></span>{{ $daysLeft }}d</span>
                                @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

        {{-- Panel lateral --}}
        <div style="display:flex;flex-direction:column;gap:16px;">

            {{-- Acciones rápidas --}}
            <div class="card" style="padding:20px;">
                <div style="font-size:13px;font-weight:600;color:var(--text-primary);margin-bottom:14px;">
                    Acciones rápidas
                </div>
                <div style="display:flex;flex-direction:column;gap:8px;">

                    <a href="{{ route('employees.create') }}"
                        style="display:flex;align-items:center;gap:12px;padding:10px 12px;border-radius:var(--r-lg);border:1px solid var(--border);text-decoration:none;transition:all 0.15s;"
                        onmouseover="this.style.background='var(--bg-surface2)'"
                        onmouseout="this.style.background='transparent'">
                        <div style="width:36px;height:36px;border-radius:var(--r-md);background:#EEF3FF;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-person-plus-fill" style="color:#4A55E8;font-size:15px;"></i>
                        </div>
                        <div>
                            <div style="font-size:13.5px;font-weight:500;color:var(--text-primary);">Nuevo empleado</div>
                            <div style="font-size:11.5px;color:var(--text-muted);">Registrar en el sistema</div>
                        </div>
                        <i class="bi bi-chevron-right" style="margin-left:auto;font-size:11px;color:var(--text-muted);"></i>
                    </a>

                    <a href="{{ route('certifications.create') }}"
                        style="display:flex;align-items:center;gap:12px;padding:10px 12px;border-radius:var(--r-lg);border:1px solid var(--border);text-decoration:none;transition:all 0.15s;"
                        onmouseover="this.style.background='var(--bg-surface2)'"
                        onmouseout="this.style.background='transparent'">
                        <div style="width:36px;height:36px;border-radius:var(--r-md);background:#ECFDF5;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-award-fill" style="color:#10B981;font-size:15px;"></i>
                        </div>
                        <div>
                            <div style="font-size:13.5px;font-weight:500;color:var(--text-primary);">Nueva certificación</div>
                            <div style="font-size:11.5px;color:var(--text-muted);">Registrar certificado</div>
                        </div>
                        <i class="bi bi-chevron-right" style="margin-left:auto;font-size:11px;color:var(--text-muted);"></i>
                    </a>

                    <a href="{{ route('courses.create') }}"
                        style="display:flex;align-items:center;gap:12px;padding:10px 12px;border-radius:var(--r-lg);border:1px solid var(--border);text-decoration:none;transition:all 0.15s;"
                        onmouseover="this.style.background='var(--bg-surface2)'"
                        onmouseout="this.style.background='transparent'">
                        <div style="width:36px;height:36px;border-radius:var(--r-md);background:#FFF7ED;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-book-fill" style="color:#F97316;font-size:15px;"></i>
                        </div>
                        <div>
                            <div style="font-size:13.5px;font-weight:500;color:var(--text-primary);">Nuevo curso</div>
                            <div style="font-size:11.5px;color:var(--text-muted);">Agregar al catálogo</div>
                        </div>
                        <i class="bi bi-chevron-right" style="margin-left:auto;font-size:11px;color:var(--text-muted);"></i>
                    </a>

                </div>
            </div>

            {{-- Resumen de salud --}}
            <div class="card" style="padding:20px;">
                <div style="font-size:13px;font-weight:600;color:var(--text-primary);margin-bottom:14px;">
                    Estado del sistema
                </div>
                @php
                $total = max($totalEmployees, 1);
                $pct = $active > 0 ? min(round(($active / max($active + $expiringSoon + $expired, 1)) * 100), 100) : 0;
                $barColor = $pct > 80 ? 'var(--success)' : ($pct > 50 ? 'var(--warning)' : 'var(--danger)');
                @endphp
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                    <span style="font-size:12.5px;color:var(--text-secondary);">Certificaciones vigentes</span>
                    <span style="font-size:13px;font-weight:600;color:var(--text-primary);">{{ $pct }}%</span>
                </div>
                <div style="width:100%;height:6px;background:var(--bg-surface2);border-radius:9999px;overflow:hidden;margin-bottom:14px;">
                    <div style="height:6px;border-radius:9999px;background:{{ $barColor }};width:{{ $pct }}%;transition:width 0.7s ease;"></div>
                </div>
                <div class="stats-mini-grid">
                    <div style="text-align:center;padding:8px 4px;border-radius:var(--r-md);background:var(--bg-surface2);">
                        <div style="font-size:1.25rem;font-weight:700;color:var(--success);">{{ $active }}</div>
                        <div style="font-size:11px;color:var(--text-muted);">Vigentes</div>
                    </div>
                    <div style="text-align:center;padding:8px 4px;border-radius:var(--r-md);background:var(--bg-surface2);">
                        <div style="font-size:1.25rem;font-weight:700;color:var(--warning);">{{ $expiringSoon }}</div>
                        <div style="font-size:11px;color:var(--text-muted);">Por vencer</div>
                    </div>
                    <div style="text-align:center;padding:8px 4px;border-radius:var(--r-md);background:var(--bg-surface2);">
                        <div style="font-size:1.25rem;font-weight:700;color:var(--danger);">{{ $expired }}</div>
                        <div style="font-size:11px;color:var(--text-muted);">Vencidas</div>
                    </div>
                </div>
            </div>

        </div>
        {{-- / panel lateral --}}

    </div>

</x-app-layout>