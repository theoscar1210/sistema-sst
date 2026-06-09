<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="page-breadcrumb">
                <a href="{{ route('dashboard') }}">Inicio</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                <a href="{{ route('certifications.index') }}">Certificaciones</a>
                <i class="bi bi-chevron-right" style="font-size:10px;"></i>
                Nueva
            </div>
            <h1 class="page-title">Nueva certificación</h1>
        </div>
        <a href="{{ route('certifications.index') }}" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
            Volver
        </a>
    </x-slot>

    <div style="max-width:720px;">
        <form action="{{ route('certifications.store') }}" method="POST">
            @csrf

            <div class="form-section">
                <div class="form-section-header">
                    <i class="bi bi-award-fill" style="color:var(--primary-600);"></i>
                    <span class="form-section-title">Datos de la certificación</span>
                </div>
                <div class="form-section-body">

                    <div class="form-group">
                        <label class="input-label">Empleado <span style="color:var(--danger);">*</span></label>
                        <select name="employee_id"
                                class="sst-input {{ $errors->has('employee_id') ? 'error' : '' }}">
                            <option value="">— Selecciona un empleado —</option>
                            @foreach($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->full_name }} · {{ $employee->document_number }}
                            </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="input-label">Curso <span style="color:var(--danger);">*</span></label>
                        <select name="course_id"
                                class="sst-input {{ $errors->has('course_id') ? 'error' : '' }}">
                            <option value="">— Selecciona un curso —</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }} ({{ $course->validity_months }} meses)
                            </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="input-label">Instituto que certifica <span style="color:var(--danger);">*</span></label>
                        <input type="text" name="institute"
                               value="{{ old('institute') }}"
                               placeholder="Nombre de la entidad certificadora"
                               class="sst-input {{ $errors->has('institute') ? 'error' : '' }}">
                        @error('institute')
                            <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="input-label">Fecha de emisión <span style="color:var(--danger);">*</span></label>
                            <input type="date" name="issue_date"
                                   value="{{ old('issue_date') }}"
                                   class="sst-input {{ $errors->has('issue_date') ? 'error' : '' }}">
                            @error('issue_date')
                                <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="input-label">Fecha de vencimiento <span style="color:var(--danger);">*</span></label>
                            <input type="date" name="expiry_date"
                                   value="{{ old('expiry_date') }}"
                                   class="sst-input {{ $errors->has('expiry_date') ? 'error' : '' }}">
                            @error('expiry_date')
                                <div class="input-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="input-label">Observaciones</label>
                        <textarea name="notes" rows="2"
                                  placeholder="Notas adicionales sobre la certificación..."
                                  class="sst-input"
                                  style="resize:vertical;">{{ old('notes') }}</textarea>
                    </div>

                </div>
                <div class="form-footer">
                    <a href="{{ route('certifications.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-floppy-fill"></i>
                        Guardar certificación
                    </button>
                </div>
            </div>

        </form>
    </div>

</x-app-layout>
