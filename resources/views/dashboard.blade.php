<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard — Sistema SST
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Tarjetas de resumen -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

                <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500">Total Empleados</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalEmployees }}</p>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-green-500">
                    <p class="text-sm text-gray-500">Certificaciones Vigentes</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $active }}</p>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-yellow-500">
                    <p class="text-sm text-gray-500">Por Vencer (30 días)</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $expiringSoon }}</p>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-5 border-l-4 border-red-500">
                    <p class="text-sm text-gray-500">Vencidas</p>
                    <p class="text-3xl font-bold text-red-600 mt-1">{{ $expired }}</p>
                </div>

            </div>

            <!-- Alerta si hay vencidos -->
            @if($expired > 0)
            <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded mb-6">
                <strong>Atención:</strong> Hay {{ $expired }} certificación(es) vencida(s).
                <a href="{{ route('certifications.index') }}" class="underline ml-2">Ver todas</a>
            </div>
            @endif

            <!-- Tabla próximas a vencer -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-gray-700">
                            Certificaciones próximas a vencer
                        </h3>
                        <a href="{{ route('certifications.index') }}"
                            class="text-blue-600 text-sm hover:underline">
                            Ver todas →
                        </a>
                    </div>

                    @if($recentExpiring->isEmpty())
                    <p class="text-gray-400 text-sm py-4 text-center">
                        No hay certificaciones próximas a vencer en los próximos 30 días.
                    </p>
                    @else
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Empleado</th>
                                <th class="px-4 py-3">Curso</th>
                                <th class="px-4 py-3">Vence</th>
                                <th class="px-4 py-3">Días restantes</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($recentExpiring as $cert)
                            @php
                            $daysLeft = now()->diffInDays($cert->expiry_date, false);
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium">
                                    {{ $cert->employee->full_name }}
                                </td>
                                <td class="px-4 py-3">{{ $cert->course->name }}</td>
                                <td class="px-4 py-3">
                                    {{ $cert->expiry_date->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-medium">
                                        {{ $daysLeft }} días
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>

            <!-- Accesos rápidos -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                <a href="{{ route('employees.create') }}"
                    class="bg-white p-4 rounded-lg shadow-sm text-center hover:shadow-md transition">
                    <p class="text-blue-600 font-medium text-sm">+ Nuevo Empleado</p>
                </a>
                <a href="{{ route('certifications.create') }}"
                    class="bg-white p-4 rounded-lg shadow-sm text-center hover:shadow-md transition">
                    <p class="text-green-600 font-medium text-sm">+ Nueva Certificación</p>
                </a>
                <a href="{{ route('employees.index') }}"
                    class="bg-white p-4 rounded-lg shadow-sm text-center hover:shadow-md transition">
                    <p class="text-gray-600 font-medium text-sm">Ver Empleados</p>
                </a>
                <a href="{{ route('certifications.index') }}"
                    class="bg-white p-4 rounded-lg shadow-sm text-center hover:shadow-md transition">
                    <p class="text-gray-600 font-medium text-sm">Ver Certificaciones</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>