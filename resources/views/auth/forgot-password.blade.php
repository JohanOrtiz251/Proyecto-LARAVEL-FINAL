<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-200 p-6 relative">
        <!-- Imagen de fondo sin opacidad ni filtro de desenfoque -->
        <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('https://img.freepik.com/fotos-premium/textura-fondo-degradado-blanco-negro-acuarela_145343-19.jpg');"></div>

        <!-- Contenedor del formulario de recuperación de contraseña -->
        <div class="relative z-10 w-full max-w-xl bg-white p-10 rounded-lg shadow-lg">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="block">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full p-3 border border-gray-300 rounded-lg bg-gray-100 bg-opacity-70 text-lg text-black focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button>
                        {{ __('Email Password Reset Link') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
