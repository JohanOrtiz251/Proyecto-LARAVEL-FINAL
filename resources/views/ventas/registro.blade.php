<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vender Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-4">
                            <div class="font-medium text-green-600">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

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

                    <form id="venderProductoForm" action="{{ route('ventas.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="cedula" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cedula</label>
                            <input type="number" name="cedula" id="cedula" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ old('cedula') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $product->name }}" required readonly>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio</label>
                            <input type="number" name="price" id="price" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $product->price }}" required readonly>
                        </div>

                        <div class="mb-4">
                            <label for="cantidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ old('cantidad') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="ubicacion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ubicación</label>
                            <input type="text" name="ubicacion" id="ubicacion" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ old('ubicacion') }}">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Correo Electrónico (opcional)</label>
                            <input type="email" name="email" id="email" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ old('email') }}">
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Vender') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('venderProductoForm').addEventListener('submit', function(event) {
            const cedula = document.getElementById('cedula').value;
            const nombre = document.getElementById('nombre').value;
            const cantidad = document.getElementById('cantidad').value;

            if (!cedula || !nombre || !cantidad) {
                event.preventDefault();
                alert('Todos los campos son obligatorios.');
            }
        });
    </script>
</x-app-layout>
