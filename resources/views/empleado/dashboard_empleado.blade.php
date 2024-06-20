<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard-empleado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />

                <!-- Botón para ir a la gestión de productos -->
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Gestión de Productos</a>
                </div>
                <div class="mt-4">
                    <a href="{{ route('suppliers.index') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Gestión de Proveedores</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
