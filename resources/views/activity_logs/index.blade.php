<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Historial de Actividad
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Fecha y hora</th>
                                <th class="px-4 py-3">Usuario</th>
                                <th class="px-4 py-3">Acción</th>
                                <th class="px-4 py-3">Módulo</th>
                                <th class="px-4 py-3">Descripción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($logs as $log)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-500 text-xs">
                                    {{ $log->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-3 font-medium">
                                    {{ $log->user->name }} {{ $log->user->last_name }}
                                </td>
                                <td class="px-4 py-3">
                                    @if($log->action === 'created')
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                        Creó
                                    </span>
                                    @elseif($log->action === 'updated')
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">
                                        Actualizó
                                    </span>
                                    @elseif($log->action === 'deleted')
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">
                                        Eliminó
                                    </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    {{ $log->model_type }}
                                </td>
                                <td class="px-4 py-3">{{ $log->description }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-400">
                                    No hay actividad registrada.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>