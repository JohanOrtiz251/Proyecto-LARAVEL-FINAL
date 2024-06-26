<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Lista de Productos') }}
                </h2>
            </div>
            <div class="w-full flex justify-center">
                <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Crear Producto') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg bg-gray-800 dark:bg-gray-800">
                <table class="table-auto w-full text-gray-300 dark:text-gray-300">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-white bg-gray-800 dark:bg-gray-700">Nombre</th>
                            <th class="px-4 py-2 text-white bg-gray-800 dark:bg-gray-700">Descripción</th>
                            <th class="px-4 py-2 text-white bg-gray-800 dark:bg-gray-700">Precio</th>
                            <th class="px-4 py-2 text-white bg-gray-800 dark:bg-gray-700">Cantidad</th>
                            <th class="px-4 py-2 text-white bg-gray-800 dark:bg-gray-700">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr class="border-t border-gray-700 dark:border-gray-600">
                            <td class="px-4 py-2 text-white font-bold text-center">{{ $product->name }}</td>
                            <td class="px-4 py-2 text-white font-bold text-center">{{ $product->description }}</td>
                            <td class="px-4 py-2 text-white font-bold text-center">${{ $product->price }}</td>
                            <td class="px-4 py-2 text-white font-bold text-center">{{ $product->quantity }}</td>
                            <td class="px-4 py-2 flex gap-2 justify-center">
                                <a href="{{ route('products.show', $product->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ver</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
