<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Nuevo Usuario
            </h2>
            <a href="{{ route('users.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Volver
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="flex flex-col gap-4">

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Nombres *
                                    </label>
                                    <input type="text" name="name"
                                        value="{{ old('name') }}"
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
                                        value="{{ old('last_name') }}"
                                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                    @error('last_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Correo electrónico *
                                </label>
                                <input type="email" name="email"
                                    value="{{ old('email') }}"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Rol *
                                </label>
                                <select name="role"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                    <option value="">-- Selecciona un rol --</option>
                                    <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>
                                        Super Administrador
                                    </option>
                                    <option value="sst" {{ old('role') === 'sst' ? 'selected' : '' }}>
                                        Usuario SST
                                    </option>
                                </select>
                                @error('role')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Contraseña *
                                </label>
                                <input type="password" name="password"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                                @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Confirmar contraseña *
                                </label>
                                <input type="password" name="password_confirmation"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                            </div>

                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                                Crear Usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>