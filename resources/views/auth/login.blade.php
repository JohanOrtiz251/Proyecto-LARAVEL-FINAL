<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-900">
        <!-- Fondo con efecto de desenfoque -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center filter blur-lg" style="background-image: url('{{ asset('images/log.jpeg') }}');"></div>
        </div>

        <!-- Contenedor del formulario -->
        <div class="relative z-10 w-full max-w-md bg-gray-800 bg-opacity-50 p-8 rounded-lg shadow-lg">
            <x-validation-errors class="mb-4 text-red-500" />

            <h1 class="text-3xl font-bold text-center text-white mb-6">Inicio de Sesión</h1>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Correo Electrónico -->
                <div>
                    <label for="email" class="block text-gray-300 text-lg font-medium mb-1">Correo Electrónico</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="ejemplo@correo.com" class="block w-full px-4 py-3 border border-gray-600 rounded-lg bg-gray-700 text-gray-300 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-gray-300 text-lg font-medium mb-1">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Mínimo 8 caracteres" class="block w-full px-4 py-3 border border-gray-600 rounded-lg bg-gray-700 text-gray-300 text-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Recordarme -->
                <div class="flex items-center">
                    <input type="checkbox" id="remember_me" name="remember" class="form-checkbox text-blue-400 h-5 w-5">
                    <label for="remember_me" class="ml-2 text-base text-gray-300">{{ __('Recordarme') }}</label>
                </div>

                <!-- Enlaces y botón -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-300 hover:text-gray-400">{{ __('¿Olvidaste tu contraseña?') }}</a>
                    @endif
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-md">
                        {{ __('Iniciar Sesión') }}
                    </button>
                </div>
            </form>

            <!-- Enlace de registro -->
            <div class="flex items-center justify-center mt-4">
                <a href="{{ route('register') }}" class="text-base text-gray-300 hover:text-gray-400">{{ __('¿No tienes una cuenta? Regístrate') }}</a>
            </div>
        </div>
    </div>
</x-guest-layout>