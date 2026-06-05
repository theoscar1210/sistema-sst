<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Acceso denegado
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-center">
                    <div class="text-red-500 text6xl font-bold mb-4">403</div>

                    <h3 class="text-xl fontsemibold text-gray-700 mb-2">
                        No tienes permiso para acceder a esta sección.
                    </h3>
                    <p class="text-gray-500 text-sm mb-6">
                        Tu rol no tiene acceso a este modulo. Si crees que esto es un error, contacta al administrador del sistema.

                    </p>

                    <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Volver al Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>