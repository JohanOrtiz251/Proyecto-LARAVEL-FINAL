<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex justify-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Lista de Productos vendidos') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded shadow-md" role="alert">
                        <div class="flex">
                            <div>
                                <p class="text-sm font-semibold">{{ __('Éxito!') }}</p>
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="GET" action="{{ route('ventas.listaventas') }}" class="mb-4 flex items-center space-x-4">
                    <div class="flex items-center">
                        <label for="category" class="text-gray-800 dark:text-gray-200">{{ __('Categoría:') }}</label>
                        <select name="category" id="category" class="form-select bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded">
                            <option value="">{{ __('Todas') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center">
                        <input type="text" name="search" class="form-input w-full bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded" placeholder="{{ __('Buscar productos...') }}" value="{{ $searchTerm }}">
                    </div>
                    <div class="flex items-center">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Filtrar') }}
                        </button>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="px-4 py-2 text-left">{{ __('Nombre') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Cantidad') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Total') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Ubicación') }}</th>
                                <th class="px-4 py-2 text-left">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr class="border-b border-gray-300 dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $order->nombre }}</td>
                                    <td class="px-4 py-2">{{ $order->cantidad }}</td>
                                    <td class="px-4 py-2">${{ $order->total }}</td>
                                    <td class="px-4 py-2">{{ $order->ubicacion }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('ventas.show', $order->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">{{ __('Factura') }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-4 py-2 text-center" colspan="5">{{ __('No hay ventas registradas.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $orders->appends(['category' => $selectedCategory, 'search' => $searchTerm])->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
