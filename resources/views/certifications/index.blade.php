<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Certificaciones
            </h2>
            <a href="{{ route('certifications.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nueva Certificación
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Empleado</th>
                                <th class="px-4 py-3">Curso</th>
                                <th class="px-4 py-3">Instituto</th>
                                <th class="px-4 py-3">Fecha emisión</th>
                                <th class="px-4 py-3">Fecha vencimiento</th>
                                <th class="px-4 py-3">Estado</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($certifications as $certification)
                            @php
                            $daysLeft = now()->diffInDays($certification->expiry_date, false);
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium">
                                    {{ $certification->employee->full_name }}
                                </td>
                                <td class="px-4 py-3">{{ $certification->course->name }}</td>
                                <td class="px-4 py-3">{{ $certification->institute }}</td>
                                <td class="px-4 py-3">{{ $certification->issue_date->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">{{ $certification->expiry_date->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">
                                    @if($daysLeft < 0)
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">
                                        Vencido
                                        </span>
                                        @elseif($daysLeft <= 30)
                                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-medium">
                                            Por vencer ({{ $daysLeft }} días)
                                            </span>
                                            @else
                                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">
                                                Vigente
                                            </span>
                                            @endif
                                </td>
                                <td class="px-4 py-3 flex gap-2">
                                    <a href="{{ route('certifications.edit', $certification) }}"
                                        class="bg-yellow-400 text-white px-3 py-1 rounded text-xs hover:bg-yellow-500">
                                        Editar
                                    </a>
                                    <form action="{{ route('certifications.destroy', $certification) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Eliminar esta certificación?')">
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
                                    No hay certificaciones registradas.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $certifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>