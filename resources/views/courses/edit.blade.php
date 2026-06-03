<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Curso
            </h2>
            <a href="{{ route('courses.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('courses.update', $course) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-col gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Nombre del curso *
                                </label>
                                <input type="text" name="name"
                                    value="{{ old('name', $course->name) }}"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb1">
                                    Vigencia (meses) *
                                </label>
                                <input type="number" name="validity_months"
                                    valua="{{ old('validity_months', $course->validity_months) }}"
                                    min="1" max="120"
                                    class="w-full border border-gray-300 rouded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                @error('validity_months')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                                Actualizar Curso</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>