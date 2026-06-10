<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sistema SST') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="auth-layout">
        <div class="auth-main">
            {{-- Panel de marca (solo desktop) --}}
            <div class="auth-brand">
                <div class="auth-brand-inner">
                    <div class="auth-brand-logo">
                        <div class="auth-brand-mark">S</div>
                        <div class="auth-brand-name">Sistema SST</div>
                    </div>
                    <div class="auth-tagline">
                        Gestión de Seguridad<br>y Salud en el Trabajo
                    </div>
                    <p class="auth-desc" style="margin-top:14px;">
                        Administra empleados, certificaciones y vencimientos con un sistema moderno, seguro y eficiente.
                    </p>
                </div>

                <ul class="auth-features">
                    <li><i class="bi bi-shield-fill-check"></i> Gestión completa de certificaciones SST</li>
                    <li><i class="bi bi-bell-fill"></i> Alertas automáticas de vencimiento</li>
                    <li><i class="bi bi-people-fill"></i> Control de empleados por área y empresa</li>
                    <li><i class="bi bi-file-earmark-arrow-down-fill"></i> Exportación a Excel y PDF</li>
                    <li><i class="bi bi-clock-history"></i> Auditoría y trazabilidad completa</li>
                </ul>
            </div>

            {{-- Panel del formulario --}}
            <div class="auth-form-panel">
                <div class="auth-form-card">

                    {{-- Logo (visible solo en móvil) --}}
                    <div class="auth-form-logo">
                        <div style="width:36px;height:36px;border-radius:8px;background:var(--primary-600);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:16px;">S</div>
                        <span style="font-size:16px;font-weight:700;color:var(--text-primary);letter-spacing:-0.02em;">Sistema SST</span>
                    </div>

                    <div class="auth-card">
                        {{ $slot }}
                    </div>

                </div>
            </div>

        </div>

        {{-- Footer --}}
        <footer class="sst-footer">
            <span>
                &copy; {{ date('Y') }} Desarrollado por <strong>Oscar Dev</strong>
                &nbsp;&middot;&nbsp;
                <a href="https://github.com/theoscar1210" target="_blank" rel="noopener">
                    <i class="bi bi-github"></i> GitHub
                </a>
                &nbsp;&middot;&nbsp;
                <a href="mailto:oscardfer2020@gmail.com">oscardfer2020@gmail.com</a>
            </span>
        </footer>

    </div>
</body>

</html>