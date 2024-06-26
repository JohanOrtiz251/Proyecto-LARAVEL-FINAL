<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalles del Proveedor') }}
            </h2>
            <a href="{{ route('suppliers.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Regresar') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">Nombre:</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $supplier->name }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">Nombre de Contacto:</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $supplier->contact_name }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">Email:</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $supplier->email }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">Teléfono:</p>
                        <p class="text-gray-800 dark:text-gray-200">{{ $supplier->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
