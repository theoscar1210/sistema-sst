<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Usuarios del Sistema
            </h2>
            <a href="{{ route('users.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Nuevo Usuario
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

            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Nombre completo</th>
                                <th class="px-4 py-3">Correo</th>
                                <th class="px-4 py-3">Rol</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium">
                                    {{ $user->name }} {{ $user->last_name }}
                                </td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    @if($user->role === 'super_admin')
                                    <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs font-medium">
                                        Super Admin
                                    </span>
                                    @else
                                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-medium">
                                        SST
                                    </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 flex gap-2">
                                    <a href="{{ route('users.edit', $user) }}"
                                        class="bg-yellow-400 text-white px-3 py-1 rounded text-xs hover:bg-yellow-500">
                                        Editar
                                    </a>
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                        onsubmit="return confirm('¿Eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">
                                            Eliminar
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-400">
                                    No hay usuarios registrados.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>