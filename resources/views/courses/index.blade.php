<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cursos
            </h2>
            <a href="{{ route('courses.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nuevo Curso
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
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
                                <th class="px-4 py-3">Nombre del curso</th>
                                <th class="px-4 py-3">Vigencia (meses)</th>
                                <th class="px-4 py-3">Descripción</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($courses as $course)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium">{{ $course->name }}</td>
                                <td class="px-4 py-3">{{ $course->validity_months }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $course->description ?? '-' }}</td>
                                <td class="px-4 py-3 flex gap-2">
                                    <a href="{{ route('courses.edit', $course) }}"
                                        class="bg-yellow-400 text-white px-3 py-1 rounded text-xs hover:bg-yellow-500">
                                        Editar
                                    </a>
                                    <form action="{{ route('courses.destroy', $course) }}" method="POST"
                                        onsubmit="return confirm('¿Eliminar esre curso?')">
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
                                <td colspan="4" class="px-4 py-6 text-center text-gray-400">
                                    No hay cursos registrados.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                    <div class="mt-4">
                        {{ $courses->links()}}
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>