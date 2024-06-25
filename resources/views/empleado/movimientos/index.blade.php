<x-emple-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Historial de Movimientos') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form action="{{ route('historial-movimientos') }}" method="GET">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="date_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filtrar por fecha:</label>
                                <input type="date" id="date_filter" name="date_filter" value="{{ request('date_filter') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-600 focus:border-indigo-300 dark:focus:border-indigo-300 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-200 rounded-md shadow-sm">
                            </div>
                            @unless ($isAdmin)
                                <div>
                                    <label for="role_filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filtrar por rol:</label>
                                    <select id="role_filter" name="role_filter" class="mt-1 block w-full border-gray-300 dark:border-gray-600 focus:border-indigo-300 dark:focus:border-indigo-300 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-200 rounded-md shadow-sm">
                                        <option value="">Todos</option>
                                        <option value="admin" {{ request('role_filter') === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="empleado" {{ request('role_filter') === 'empleado' ? 'selected' : '' }}>Empleado</option>
                                    </select>
                                </div>
                            @endunless
                            <div class="flex items-end">
                                <button type="submit" class="mt-8 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Filtrar
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Tabla de historial de movimientos -->
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 mt-8">
                        <thead>
                            <tr class="dark:text-gray-400">
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Usuario
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acción
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Entidad Afectada
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Detalles
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha y Hora
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:text-gray-400">
                            @foreach ($audits as $audit)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $audit->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ ucfirst($audit->action) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ ucfirst($audit->entity_type) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $audit->details }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $audit->created_at->format('d/m/Y H:i:s') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-emple-layout>
