<x-emple-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div>
                        <p class="font-semibold">Nombre:</p>
                        <p>{{ $product->name }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Descripción:</p>
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Precio:</p>
                        <p>{{ $product->price }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Cantidad:</p>
                        <p>{{ $product->quantity }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Categoría ID:</p>
                        <p>{{ $product->category_id }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Proveedor ID:</p>
                        <p>{{ $product->supplier_id }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Fecha de caducidad:</p>
                        <p>{{ $product->expiry_date }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Ubicación:</p>
                        <p>{{ $product->location }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-emple-layout>
