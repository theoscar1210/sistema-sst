<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="page-breadcrumb">
                <a href="{{ route('dashboard') }}">Inicio</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                <a href="{{ route('employees.index') }}">Empleados</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                Nuevo
            </div>
            <h1 class="page-title">Registrar empleado</h1>
        </div>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
            Volver
        </a>
    </x-slot>

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div class="form-section">
            <div class="form-section-header">
                <i class="bi bi-person-vcard-fill" style="color:var(--primary-600);"></i>
                <span class="form-section-title">Información personal</span>
            </div>
            <div class="form-section-body">
                <div class="form-grid-2">

                    <div class="form-group">
                        <label class="input-label">Número de documento <span style="color:var(--danger);">*</span></label>
                        <input type="text" name="document_number"
                               value="{{ old('document_number') }}"
                               placeholder="Ej: 10234567890"
                               class="sst-input {{ $errors->has('document_number') ? 'error' : '' }}">
                        @error('document_number')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="input-label">Nombres <span style="color:var(--danger);">*</span></label>
                        <input type="text" name="name"
                               value="{{ old('name') }}"
                               placeholder="Nombres del empleado"
                               class="sst-input {{ $errors->has('name') ? 'error' : '' }}">
                        @error('name')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="input-label">Apellidos <span style="color:var(--danger);">*</span></label>
                        <input type="text" name="last_name"
                               value="{{ old('last_name') }}"
                               placeholder="Apellidos del empleado"
                               class="sst-input {{ $errors->has('last_name') ? 'error' : '' }}">
                        @error('last_name')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="input-label">Correo electrónico</label>
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="correo@empresa.com"
                               class="sst-input {{ $errors->has('email') ? 'error' : '' }}">
                        @error('email')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="input-label">Teléfono</label>
                        <input type="text" name="phone"
                               value="{{ old('phone') }}"
                               placeholder="Número de contacto"
                               class="sst-input">
                        @error('phone')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-header">
                <i class="bi bi-building-fill" style="color:var(--primary-600);"></i>
                <span class="form-section-title">Información laboral</span>
            </div>
            <div class="form-section-body">
                <div class="form-grid-2">

                    <div class="form-group">
                        <label class="input-label">Área <span style="color:var(--danger);">*</span></label>
                        <input type="text" name="area"
                               value="{{ old('area') }}"
                               placeholder="Ej: Operaciones, RRHH"
                               class="sst-input {{ $errors->has('area') ? 'error' : '' }}">
                        @error('area')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="input-label">Cargo <span style="color:var(--danger);">*</span></label>
                        <input type="text" name="position"
                               value="{{ old('position') }}"
                               placeholder="Ej: Técnico, Supervisor"
                               class="sst-input {{ $errors->has('position') ? 'error' : '' }}">
                        @error('position')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="input-label">Empresa <span style="color:var(--danger);">*</span></label>
                        <input type="text" name="company"
                               value="{{ old('company') }}"
                               placeholder="Razón social o nombre"
                               class="sst-input {{ $errors->has('company') ? 'error' : '' }}">
                        @error('company')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="form-footer">
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-floppy-fill"></i>
                    Guardar empleado
                </button>
            </div>
        </div>

    </form>

</x-app-layout>
