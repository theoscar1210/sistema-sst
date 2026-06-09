<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="page-breadcrumb">
                <a href="{{ route('dashboard') }}">Inicio</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                <a href="{{ route('users.index') }}">Usuarios</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                Nuevo
            </div>
            <h1 class="page-title">Nuevo usuario</h1>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
            Volver
        </a>
    </x-slot>

    <div style="max-width:600px;">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="form-section">
                <div class="form-section-header">
                    <i class="bi bi-person-fill-gear" style="color:var(--primary-600);"></i>
                    <span class="form-section-title">Información del usuario</span>
                </div>
                <div class="form-section-body">

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="input-label">Nombres <span style="color:var(--danger);">*</span></label>
                            <input type="text" name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Nombres"
                                   class="sst-input {{ $errors->has('name') ? 'error' : '' }}">
                            @error('name')
                                <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="input-label">Apellidos <span style="color:var(--danger);">*</span></label>
                            <input type="text" name="last_name"
                                   value="{{ old('last_name') }}"
                                   placeholder="Apellidos"
                                   class="sst-input {{ $errors->has('last_name') ? 'error' : '' }}">
                            @error('last_name')
                                <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="input-label">Correo electrónico <span style="color:var(--danger);">*</span></label>
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="correo@empresa.com"
                               class="sst-input {{ $errors->has('email') ? 'error' : '' }}">
                        @error('email')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="input-label">Rol <span style="color:var(--danger);">*</span></label>
                        <select name="role" class="sst-input {{ $errors->has('role') ? 'error' : '' }}">
                            <option value="">— Selecciona un rol —</option>
                            <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>
                                Super Administrador
                            </option>
                            <option value="sst" {{ old('role') === 'sst' ? 'selected' : '' }}>
                                Usuario SST
                            </option>
                        </select>
                        @error('role')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="form-section">
                <div class="form-section-header">
                    <i class="bi bi-shield-lock-fill" style="color:var(--primary-600);"></i>
                    <span class="form-section-title">Contraseña</span>
                </div>
                <div class="form-section-body">
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="input-label">Contraseña <span style="color:var(--danger);">*</span></label>
                            <input type="password" name="password"
                                   placeholder="Mínimo 8 caracteres"
                                   class="sst-input {{ $errors->has('password') ? 'error' : '' }}">
                            @error('password')
                                <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="input-label">Confirmar contraseña <span style="color:var(--danger);">*</span></label>
                            <input type="password" name="password_confirmation"
                                   placeholder="Repetir contraseña"
                                   class="sst-input">
                        </div>
                    </div>
                </div>
                <div class="form-footer">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-plus-fill"></i>
                        Crear usuario
                    </button>
                </div>
            </div>

        </form>
    </div>

</x-app-layout>
