<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class=" font-semibold text-xl text-gray-800 leading-tight">
                Editar Empleado
            </h2>

            <a href="{{ route('employees.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Volver
            </a>
        </div>


    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('employees.update', $employee) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Número de documento *
                                </label>
                                <input type="text" name="document_number"
                                    value="" {{ old('document_number', $employee->document_number) }}"
                                    class="w-full border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                @error('document_number')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Nombres *
                                </label>
                                <input type="text" name="name"
                                    value="{{ old('name', $employee->name) }}"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Apellidos *
                                </label>
                                <input type="text" name="last_name"
                                    value="{{ old('last_name', $employee->last_name) }}"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                @error('last_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Cargo *
                                </label>
                                <input type="text" name="position"
                                    value="{{ old('position', $employee->position) }}"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                @error('position')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Empresa *
                                </label>
                                <input type="text" name="company"
                                    value="{{ old('company', $employee->company) }}"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                @error('company')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Teléfono
                                </label>
                                <input type="text" name="phone"
                                    value="{{ old('phone', $employee->phone) }}"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Correo electrónico
                                </label>
                                <input type="email" name="email"
                                    value="{{ old('email', $employee->email) }}"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Estado
                                </label>
                                <select name="is_active"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                    <option value="1" {{ $employee->is_active ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ !$employee->is_active ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>

                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                                Actualizar Empleado
                            </button>
                        </div>






                    </form>

                </div>
            </div>

        </div>

    </div>




</x-app-layout>