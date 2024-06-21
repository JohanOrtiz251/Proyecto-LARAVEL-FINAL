<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-200 p-6 relative">
        <!-- Imagen de fondo sin opacidad ni filtro de desenfoque -->
        <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('https://u7.uidownload.com/vector/581/993/vector-abstract-dark-grey-diagonal-shiny-lines-background-vector-image-.jpg');"></div>

        <!-- Contenedor del formulario con fondo semi-transparente y sombra -->
        <div class="relative z-10 w-full max-w-xl bg-white bg-opacity-50 p-10 rounded-lg shadow-lg">
            <x-validation-errors class="mb-4 text-red-500" />

            <h1 class="text-3xl font-bold text-center text-gray-900 mb-6">Registro</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-6">
                    <label for="name" class="block text-lg font-medium text-gray-900 mb-1">{{ __('Name') }}</label>
                    <input id="name" class="block w-full p-3 border border-gray-300 rounded-lg bg-gray-100 bg-opacity-70 text-lg text-black focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-lg font-medium text-gray-900 mb-1">{{ __('Email') }}</label>
                    <input id="email" class="block w-full p-3 border border-gray-300 rounded-lg bg-gray-100 bg-opacity-70 text-lg text-black focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-lg font-medium text-gray-900 mb-1">{{ __('Password') }}</label>
                    <input id="password" class="block w-full p-3 border border-gray-300 rounded-lg bg-gray-100 bg-opacity-70 text-lg text-black focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-lg font-medium text-gray-900 mb-1">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" class="block w-full p-3 border border-gray-300 rounded-lg bg-gray-100 bg-opacity-70 text-lg text-black focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="mb-6">
                    <label for="role" class="block text-lg font-medium text-gray-900 mb-1">{{ __('Role') }}</label>
                    <div class="relative">
                        <select id="role" name="role_id" class="block w-full bg-gray-100 bg-opacity-70 border border-gray-300 text-lg text-black py-3 px-4 pr-8 rounded shadow-sm leading-tight focus:outline-none focus:border-gray-500 focus:shadow-outline">
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
