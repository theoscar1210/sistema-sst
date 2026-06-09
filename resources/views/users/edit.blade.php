<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="page-breadcrumb">
                <a href="{{ route('dashboard') }}">Inicio</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                <a href="{{ route('users.index') }}">Usuarios</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                Editar
            </div>
            <h1 class="page-title">Editar usuario</h1>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
            Volver
        </a>
    </x-slot>

    <div style="max-width:600px;">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

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
                                   value="{{ old('name', $user->name) }}"
                                   class="sst-input {{ $errors->has('name') ? 'error' : '' }}">
                            @error('name')
                                <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="input-label">Apellidos <span style="color:var(--danger);">*</span></label>
                            <input type="text" name="last_name"
                                   value="{{ old('last_name', $user->last_name) }}"
                                   class="sst-input {{ $errors->has('last_name') ? 'error' : '' }}">
                            @error('last_name')
                                <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="input-label">Correo electrónico <span style="color:var(--danger);">*</span></label>
                        <input type="email" name="email"
                               value="{{ old('email', $user->email) }}"
                               class="sst-input {{ $errors->has('email') ? 'error' : '' }}">
                        @error('email')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="input-label">Rol <span style="color:var(--danger);">*</span></label>
                        <select name="role" class="sst-input {{ $errors->has('role') ? 'error' : '' }}">
                            <option value="super_admin" {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>
                                Super Administrador
                            </option>
                            <option value="sst" {{ old('role', $user->role) === 'sst' ? 'selected' : '' }}>
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
                    <span class="form-section-title">Cambiar contraseña</span>
                </div>
                <div class="form-section-body">
                    <div class="sst-alert sst-alert-info" style="margin-bottom:16px;">
                        <i class="bi bi-info-circle-fill"></i>
                        Deja los campos vacíos si no deseas cambiar la contraseña.
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="input-label">Nueva contraseña</label>
                            <input type="password" name="password"
                                   placeholder="Nueva contraseña"
                                   class="sst-input {{ $errors->has('password') ? 'error' : '' }}">
                            @error('password')
                                <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="input-label">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation"
                                   placeholder="Repetir contraseña"
                                   class="sst-input">
                        </div>
                    </div>
                </div>
                <div class="form-footer">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-floppy-fill"></i>
                        Actualizar usuario
                    </button>
                </div>
            </div>

        </form>
    </div>

</x-app-layout>
