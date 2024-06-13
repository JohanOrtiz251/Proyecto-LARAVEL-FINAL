<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Lista de Productos a vender') }}
                </h2>
            </div>
            <div class="w-full flex justify-center">
                <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Registro de productos') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="GET" action="{{ route('ventas.index') }}" class="mb-4">
                    <div class="flex items-center">
                        <label for="category" class="mr-2 text-gray-800 dark:text-gray-200">Categoría:</label>
                        <select name="category" id="category" class="form-select bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded">
                            <option value="">Todas</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="ml-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Filtrar') }}
                        </button>
                    </div>
                </form>

                <table class="table-auto w-full ">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Precio</th>
                            <th class="px-4 py-2">Cantidad</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td class="border px-4 py-2">{{ $product->name }}</td>
                                <td class="border px-4 py-2">${{ $product->price }}</td>
                                <td class="border px-4 py-2">{{ $product->quantity }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ver</a>
                                    <a href="{{ route('ventas.edit', $product->id) }}" class="bg-black-500 hover:bg-black-700 text-white font-bold py-2 px-4 rounded">Vender</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
