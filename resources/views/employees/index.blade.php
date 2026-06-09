<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Empleados

            </h2>
            <a href="{{ route('employees.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nuevo Empleado
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success')}}
            </div>
            @endif

            {{-- Formulario de Busqueda --}}
            <form method="GET" action="{{ route('employees.index') }}" class="mb-4">
                <div class="grid grid-cols-1 md:gird-cols-4 gap-3">
                    <input type="text"
                        name="search"
                        value="{{ request('serach') }}"
                        placeholder="Nombre, documento, empresa..."
                        class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    <input type="text"
                        name="area"
                        value="{{request('area') }}"
                        placeholder="Filtrar por área..."
                        class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    <select name="status"
                        class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                        <option value="">Todos los estados</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Activos</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactivos</option>
                    </select>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 flex-1">
                            Buscar
                        </button>
                        <a href="{{ route('employees.index') }}"
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded text-sm hover:bg-gray-300 flex-1 text-center">
                            Limpiar
                        </a>
                    </div>
                </div>

            </form>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Documento</th>
                                <th class="px-4 py-3">Nombre completo</th>
                                <th class="px-4 py-3">Área</th>
                                <th class="px-4 py-3">Cargo</th>
                                <th class="px-4 py-3">Empresa</th>
                                <th class="px-4 py-3">Estado</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse($employees as $employee)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $employee->document_number }}</td>
                                <td class="px-4 py-3">{{ $employee->full_name }}</td>
                                <td class="px-4 py-3">{{ $employee->area }}</td>
                                <td class="px-4 py-3">{{ $employee->position }}</td>
                                <td class="px-4 py-3">{{ $employee->company }}</td>
                                <td class="px-4 py-3">
                                    @if($employee->is_active)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Activo</span>
                                    @else
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Inactivo</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 flex gap-2">
                                    <a href="{{ route('employees.edit', $employee) }}"
                                        class=" bg-yellow-400 text-white px-3 py-1 rounded text-xs hover:bg-yellow-500">
                                        Editar
                                    </a>

                                    <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este empleado?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-gray-400">
                                    No hay empleados registrados.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                    <div class="mt-4">
                        {{ $employees->links() }}
                    </div>

                </div>
            </div>

        </div>

    </div>




</x-app-layout>