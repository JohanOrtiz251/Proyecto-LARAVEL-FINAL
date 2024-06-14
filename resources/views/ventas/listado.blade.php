<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Lista de Productos vendidos') }}
                </h2>
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

                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Cantidad</th>
                            <th class="px-4 py-2">Total</th>
                            <th class="px-4 py-2">Ubicación</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="border px-4 py-2">{{ $order->nombre }}</td>
                                <td class="border px-4 py-2">{{ $order->cantidad }}</td>
                                <td class="border px-4 py-2">${{ $order->total }}</td>
                                <td class="border px-4 py-2">{{ $order->ubicacion }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('ventas.show', $order->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Factura</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
