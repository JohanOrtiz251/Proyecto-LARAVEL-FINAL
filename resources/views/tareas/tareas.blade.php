<!-- resources/views/tareas/tareas.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="w-full flex justify-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Lista de Tareas
                </h2>
            </div>

            <div class="w-full flex justify-center">
                <a href="{{ route('tareas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Asignar Tareas') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="GET" action="{{ route('tareas.index') }}" class="mb-4 flex items-center relative">
                    <input type="text" name="search" class="form-input w-full bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded" placeholder="Buscar tareas..." value="{{ $searchTerm }}">
                    <select name="employee" class="form-select w-full bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded ml-4">
                        <option value="">{{ __('Todos los empleados') }}</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ $employeeId == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Buscar
                    </button>
                </form>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($tasks as $task)
                        <div class="relative border rounded-lg p-6 mb-6
                            @if (is_null($task->completed))
                                bg-red-100 dark:bg-red-800 border-red-300 dark:border-red-700 text-red-800 dark:text-red-200
                            @elseif ($task->completed)
                                bg-green-100 dark:bg-green-800 border-green-300 dark:border-green-700 text-green-800 dark:text-green-200
                            @else
                                bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200
                            @endif
                        ">
                            <h3 class="text-lg font-semibold">{{ $task->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $task->description }}</p>
                            <div class="flex items-center justify-between mt-4">
                                <span>Fecha de Creación: {{ $task->created_at->format('d/m/Y') }}</span>
                                <span>Asignado a: {{ $task->assignedTo ? $task->assignedTo->name : 'No asignado' }}</span>
                                <div class="absolute right-4 top-4 z-10">
                                    <button class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-bold py-2 px-4 rounded focus:outline-none" onclick="toggleDropdown('{{ $task->id }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM1 10a9 9 0 1118 0 9 9 0 01-18 0z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <div id="dropdown-{{ $task->id }}" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg z-20 hidden">
                                        <a href="{{ route('tareas.show', $task->id) }}" class="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Ver</a>
                                        <a href="{{ route('tareas.edit', $task->id) }}" class="block px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Editar</a>
                                        <form action="{{ route('tareas.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $tasks->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown(taskId) {
            const dropdown = document.getElementById('dropdown-' + taskId);
            dropdown.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
