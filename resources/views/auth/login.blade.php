<div>
    <x-guest-layout>
        <div class="min-h-screen flex items-center justify-center bg-gray-900 p-6 relative">
            <!-- Imagen de fondo con opacidad y filtro de desenfoque -->
            <div class="absolute inset-0 bg-cover bg-center opacity-80" style="background-image: url('https://img.freepik.com/fotos-premium/textura-fondo-degradado-blanco-negro-acuarela_145343-19.jpg'); filter: blur(5px);"></div>

            <!-- Contenedor del formulario con fondo semi-transparente y sombra -->
            <div class="relative w-full max-w-xl bg-gray-800 bg-opacity-50 p-10 rounded-lg shadow-lg">
                <x-validation-errors class="mb-4 text-red-500" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <h1 class="text-3xl font-bold text-center text-white mb-6">Inicio de Sesión</h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="email" class="block text-lg text-white">{{ __('Correo Electrónico') }}</label>
                        <input id="email" class="block mt-1 w-full p-3 border border-gray-600 rounded-lg bg-transparent text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-lg text-white">{{ __('Contraseña') }}</label>
                        <input id="password" class="block mt-1 w-full p-3 border border-gray-600 rounded-lg bg-transparent text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="block mb-4">
                        <label for="remember_me" class="flex items-center">
                            <input type="checkbox" id="remember_me" name="remember" class="form-checkbox text-blue-400">
                            <span class="ml-2 text-base text-white">{{ __('Recordarme') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-white hover:text-gray-300" href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                            {{ __('Iniciar Sesión') }}
                        </button>
                    </div>
                </form>

                <div class="flex items-center justify-center">
                    <a class="underline text-base text-white hover:text-gray-300" href="{{ route('register') }}">
                        {{ __('¿No tienes una cuenta? Regístrate') }}
                    </a>
                </div>
            </div>
        </div>
    </x-guest-layout>
</div>
