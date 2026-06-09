<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="page-breadcrumb">
                <a href="{{ route('dashboard') }}">Inicio</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                <a href="{{ route('courses.index') }}">Cursos</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                Editar
            </div>
            <h1 class="page-title">Editar curso</h1>
        </div>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
            Volver
        </a>
    </x-slot>

    <div style="max-width:600px;">
        <form action="{{ route('courses.update', $course) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-section">
                <div class="form-section-header">
                    <i class="bi bi-book-fill" style="color:#F97316;"></i>
                    <span class="form-section-title">Información del curso</span>
                </div>
                <div class="form-section-body">

                    <div class="form-group">
                        <label class="input-label">Nombre del curso <span style="color:var(--danger);">*</span></label>
                        <input type="text" name="name"
                               value="{{ old('name', $course->name) }}"
                               class="sst-input {{ $errors->has('name') ? 'error' : '' }}">
                        @error('name')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="input-label">Vigencia (meses) <span style="color:var(--danger);">*</span></label>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <input type="number" name="validity_months"
                                   value="{{ old('validity_months', $course->validity_months) }}"
                                   min="1" max="120"
                                   class="sst-input {{ $errors->has('validity_months') ? 'error' : '' }}"
                                   style="max-width:160px;">
                            <span style="font-size:13px;color:var(--text-muted);">meses de validez</span>
                        </div>
                        @error('validity_months')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="input-label">Descripción</label>
                        <textarea name="description" rows="3"
                                  class="sst-input"
                                  style="resize:vertical;">{{ old('description', $course->description) }}</textarea>
                    </div>

                </div>
                <div class="form-footer">
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-floppy-fill"></i>
                        Actualizar curso
                    </button>
                </div>
            </div>

        </form>
    </div>

</x-app-layout>
