<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Lista de Proveedores') }}
                </h2>
            </div>
            <div class="w-full flex justify-center">
                <a href="{{ route('suppliers.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Crear Proveedor') }}
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
                            <th class="px-4 py-2 text-white bg-gray-800 dark:bg-gray-700">ID</th>
                            <th class="px-4 py-2 text-white bg-gray-800 dark:bg-gray-700">Nombre</th>
                            <th class="px-4 py-2 text-white bg-gray-800 dark:bg-gray-700">Nombre de Contacto</th>
                            <th class="px-4 py-2 text-white bg-gray-800 dark:bg-gray-700">Email</th>
                            <th class="px-4 py-2 text-white bg-gray-800 dark:bg-gray-700">Teléfono</th>
                            <th class="px-4 py-2 text-white bg-gray-800 dark:bg-gray-700">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                        <tr class="border-t border-gray-700 dark:border-gray-600">
                            <td class="px-4 py-2 text-white text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 text-white font-bold text-center">{{ $supplier->name }}</td>
                            <td class="px-4 py-2 text-white font-bold text-center">{{ $supplier->contact_name }}</td>
                            <td class="px-4 py-2 text-white font-bold text-center">{{ $supplier->email }}</td>
                            <td class="px-4 py-2 text-white font-bold text-center">{{ $supplier->phone }}</td>
                            <td class="px-4 py-2 flex gap-2 justify-center">
                                <a href="{{ route('suppliers.show', $supplier->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ver</a>
                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('¿Estás seguro de que deseas eliminar este proveedor?')">Eliminar</button>
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
