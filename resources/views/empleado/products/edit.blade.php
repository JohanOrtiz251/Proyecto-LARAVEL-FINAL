<x-emple-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Producto') }}
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
                    <form action="{{ route('empleado.products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                            <input type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $product->name }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $product->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio</label>
                            <input type="number" name="price" id="price" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $product->price }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cantidad</label>
                            <input type="number" name="quantity" id="quantity" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $product->quantity }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categoría ID</label>
                            <input type="number" name="category_id" id="category_id" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $product->category_id }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="supplier_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Proveedor ID</label>
                            <input type="number" name="supplier_id" id="supplier_id" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $product->supplier_id }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="expiry_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de caducidad</label>
                            <input type="date" name="expiry_date" id="expiry_date" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $product->expiry_date }}">
                        </div>
                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ubicación</label>
                            <input type="text" name="location" id="location" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $product->location }}">
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Guardar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-emple-layout>
