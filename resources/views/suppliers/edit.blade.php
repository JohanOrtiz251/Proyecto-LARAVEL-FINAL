<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Proveedor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">
                                {{ __('¡Ups! Algo salió mal.') }}
                            </div>

                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                            <input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $supplier->name }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="contact_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre de Contacto</label>
                            <input type="text" name="contact_name" id="contact_name" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $supplier->contact_name }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" name="email" id="email" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $supplier->email }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
                            <input type="text" name="phone" id="phone" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $supplier->phone }}" required>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Guardar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
