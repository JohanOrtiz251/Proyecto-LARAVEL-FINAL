<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Lista de Categorías') }}
                </h2>
            </div>
            <div class="w-full flex justify-center">
                <a href="{{ route('categorys.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Crear Categoría') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-white bg-gray-800 dark:bg-gray-700">Nombre</th>
                            <th class="px-4 py-2 text-white bg-gray-800 dark:bg-gray-700">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorys as $category)
                        <tr>
                            <td class="border-t-0 border-l-0 border-r-0 px-4 py-2 text-white font-bold">{{ $category->name }}</td>
                            <td class="border-t-0 border-l-0 border-r-0 px-4 py-2">
                                <a href="{{ route('categorys.show', $category->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ver</a>
                                <a href="{{ route('categorys.edit', $category->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                                <form action="{{ route('categorys.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">Eliminar</button>
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
