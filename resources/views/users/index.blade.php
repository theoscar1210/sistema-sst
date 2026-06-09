<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="page-breadcrumb">
                <a href="{{ route('dashboard') }}">Inicio</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                Usuarios
            </div>
            <h1 class="page-title">Usuarios del sistema</h1>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>
            Nuevo usuario
        </a>
    </x-slot>

    @if(session('success'))
    <div class="sst-alert sst-alert-success" style="margin-bottom:20px;"
         x-data x-init="setTimeout(() => $el.style.display='none', 4000)">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="sst-alert sst-alert-danger" style="margin-bottom:20px;"
         x-data x-init="setTimeout(() => $el.style.display='none', 5000)">
        <i class="bi bi-exclamation-triangle-fill"></i>
        {{ session('error') }}
    </div>
    @endif

    {{-- Tabla --}}
    <div class="table-card">
        <div class="table-toolbar">
            <div class="table-toolbar-left">
                <span style="font-size:13px;color:var(--text-secondary);">
                    <strong style="color:var(--text-primary);">{{ $users->total() }}</strong>
                    usuarios registrados
                </span>
            </div>
        </div>

        <table class="sst-table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Correo electrónico</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:32px;height:32px;border-radius:50%;background:{{ $user->role === 'super_admin' ? '#F3E8FF' : 'var(--primary-50)' }};color:{{ $user->role === 'super_admin' ? '#7E22CE' : 'var(--primary-700)' }};display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;flex-shrink:0;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:500;font-size:13.5px;color:var(--text-primary);">
                                    {{ $user->name }} {{ $user->last_name }}
                                </div>
                                @if($user->id === auth()->id())
                                <div style="font-size:11px;color:var(--primary-600);margin-top:1px;">Tú</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="text-muted" style="font-size:13px;">{{ $user->email }}</td>
                    <td>
                        @if($user->role === 'super_admin')
                            <span class="badge" style="background:#F3E8FF;color:#6B21A8;border-color:#D8B4FE;">
                                <span class="dot"></span>Super Admin
                            </span>
                        @else
                            <span class="badge badge-pending">
                                <span class="dot"></span>SST
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('users.edit', $user) }}"
                               class="btn btn-ghost btn-xs"
                               data-tooltip="Editar usuario">
                                <i class="bi bi-pencil"></i>
                                Editar
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar usuario {{ addslashes($user->name) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-ghost btn-xs"
                                        style="color:var(--danger);"
                                        data-tooltip="Eliminar">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="table-empty">
                            <i class="bi bi-person-fill-gear"></i>
                            <p>No hay usuarios registrados.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="table-footer">
            <div class="pagination-wrapper" style="flex:1;">
                {{ $users->links() }}
            </div>
        </div>
    </div>

</x-app-layout>
