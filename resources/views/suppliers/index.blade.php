<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="inline-block">
                <h2 class="font-semibold text-xl text-white dark:text-gray-200 leading-tight">
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-blue-500">ID</th>
                            <th class="px-4 py-2 text-blue-500">Nombre</th>
                            <th class="px-4 py-2 text-blue-500">Nombre de Contacto</th>
                            <th class="px-4 py-2 text-blue-500">Email</th>
                            <th class="px-4 py-2 text-blue-500">Teléfono</th>
                            <th class="px-4 py-2 text-blue-500">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                        <tr>
                            <td class="border px-4 py-2 text-white">{{ $loop->iteration }}</td>
                            <td class="border px-4 py-2 text-white">{{ $supplier->name }}</td>
                            <td class="border px-4 py-2 text-white">{{ $supplier->contact_name }}</td>
                            <td class="border px-4 py-2 text-white">{{ $supplier->email }}</td>
                            <td class="border px-4 py-2 text-white">{{ $supplier->phone }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('suppliers.show', $supplier->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ver</a>
                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display: inline-block;">
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
