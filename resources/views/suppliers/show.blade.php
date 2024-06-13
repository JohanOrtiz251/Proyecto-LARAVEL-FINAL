<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Proveedor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div>
                        <p class="font-semibold">Nombre:</p>
                        <p>{{ $supplier->name }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Nombre de Contacto:</p>
                        <p>{{ $supplier->contact_name }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Email:</p>
                        <p>{{ $supplier->email }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Teléfono:</p>
                        <p>{{ $supplier->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
