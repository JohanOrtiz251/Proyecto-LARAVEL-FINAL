<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="w-full flex justify-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Lista de Productos a vender') }}
                </h2>
            </div>
            <div class="w-full flex justify-center">
                <a href="{{ route('ventas.listaventas') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Registro de las ventass') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Éxito!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form method="GET" action="{{ route('ventas.index') }}" class="mb-4 flex items-center">
                    <label for="category" class="mr-2 text-gray-800 dark:text-gray-200">Categoría:</label>
                    <select name="category" id="category" class="form-select bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded">
                        <option value="">Todas</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    <input type="text" name="search" class="form-input w-full bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded ml-4" placeholder="Buscar productos..." value="{{ $searchTerm }}">
                    <button type="submit" class="ml-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Filtrar') }}
                    </button>
                </form>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                    <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-4 bg-white dark:bg-gray-800">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $product->name }}</h3>
                            <span class="text-gray-500 dark:text-gray-400">${{ $product->price }}</span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">{{ $product->description }}</p>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-gray-800 dark:text-gray-200">Stock: {{ $product->quantity }}</span>
                            <div class="flex space-x-2">
                                <a href="{{ route('products.show', $product->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ver</a>
                                <a href="{{ route('ventas.edit', $product->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Vender</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $products->links('pagination::tailwind') }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
