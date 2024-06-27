<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-900">
        <!-- Fondo con efecto de desenfoque -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center filter blur-lg" style="background-image: url('{{ asset('images/re.jpeg') }}');"></div>
        </div>

        <!-- Contenedor del formulario -->
        <div class="relative z-10 w-full max-w-md bg-gray-800 bg-opacity-50 p-8 rounded-lg shadow-lg">
            <x-validation-errors class="mb-4 text-red-500" />

            <h1 class="text-3xl font-bold text-center text-white mb-6">Registro</h1>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-gray-300 text-lg font-medium mb-1">Nombre</label>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Tu nombre" class="block w-full px-4 py-3 border border-gray-600 rounded-lg bg-gray-700 text-gray-300 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Correo Electrónico -->
                <div>
                    <label for="email" class="block text-gray-300 text-lg font-medium mb-1">Correo Electrónico</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="ejemplo@correo.com" class="block w-full px-4 py-3 border border-gray-600 rounded-lg bg-gray-700 text-gray-300 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-gray-300 text-lg font-medium mb-1">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres" class="block w-full px-4 py-3 border border-gray-600 rounded-lg bg-gray-700 text-gray-300 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Confirmar contraseña -->
                <div>
                    <label for="password_confirmation" class="block text-gray-300 text-lg font-medium mb-1">Confirmar contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repite tu contraseña" class="block w-full px-4 py-3 border border-gray-600 rounded-lg bg-gray-700 text-gray-300 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Rol -->
                <div>
                    <label for="role" class="block text-gray-300 text-lg font-medium mb-1">Rol</label>
                    <select id="role" name="role_id" class="block w-full px-4 py-3 border border-gray-600 rounded-lg bg-gray-700 text-gray-300 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Enlaces y botón -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-gray-400">¿Ya tienes cuenta? Inicia sesión aquí</a>
                    <x-button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-md">
                        Registrarse
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>