<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center py-4">
            {{ __('Detalles del Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="space-y-6">
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                        <p class="font-semibold text-lg text-gray-900 dark:text-gray-100">Nombre:</p>
                        <p class="text-gray-800 dark:text-gray-300">{{ $product->name }}</p>
                    </div>
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                        <p class="font-semibold text-lg text-gray-900 dark:text-gray-100">Descripción:</p>
                        <p class="text-gray-800 dark:text-gray-300">{{ $product->description }}</p>
                    </div>
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                        <p class="font-semibold text-lg text-gray-900 dark:text-gray-100">Precio:</p>
                        <p class="text-gray-800 dark:text-gray-300">{{ $product->price }}</p>
                    </div>
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                        <p class="font-semibold text-lg text-gray-900 dark:text-gray-100">Cantidad:</p>
                        <p class="text-gray-800 dark:text-gray-300">{{ $product->quantity }}</p>
                    </div>
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                        <p class="font-semibold text-lg text-gray-900 dark:text-gray-100">Categoría ID:</p>
                        <p class="text-gray-800 dark:text-gray-300">{{ $product->category_id }}</p>
                    </div>
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                        <p class="font-semibold text-lg text-gray-900 dark:text-gray-100">Proveedor ID:</p>
                        <p class="text-gray-800 dark:text-gray-300">{{ $product->supplier_id }}</p>
                    </div>
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                        <p class="font-semibold text-lg text-gray-900 dark:text-gray-100">Fecha de caducidad:</p>
                        <p class="text-gray-800 dark:text-gray-300">{{ $product->expiry_date }}</p>
                    </div>
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                        <p class="font-semibold text-lg text-gray-900 dark:text-gray-100">Ubicación:</p>
                        <p class="text-gray-800 dark:text-gray-300">{{ $product->location }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
