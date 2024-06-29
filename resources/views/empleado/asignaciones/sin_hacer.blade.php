<!-- resources/views/empleado/asignaciones/no_realizadas.blade.php -->

<x-emple-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight center">
            Tareas Asignadas
        </h2>

        <div class="flex justify-end">
            <a href="{{ route('empleado.tareas.realizadas') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
                {{ __('Tareas Realizadas') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if ($tareas->isEmpty())
                    <p class="text-gray-800 dark:text-gray-200">No tienes tareas asignadas actualmente.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($tareas as $tarea)
                            <div class="relative border border-gray-300 dark:border-gray-700 rounded-lg p-6 bg-white dark:bg-gray-800 mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $tarea->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-400">{{ $tarea->description }}</p>
                                <form action="{{ route('asignacion.completar', $tarea->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="completed" class="mt-4">
                                        <option value="0" {{ !$tarea->completed ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ $tarea->completed ? 'selected' : '' }}>Sí</option>
                                    </select>
                                    <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
                                </form>
                                <a href="{{ route('empleado.tareas.show', $tarea->id) }}" class="absolute right-4 bottom-4 bg-yellow-400 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                                    Ver
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $tareas->links('pagination::tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-emple-layout>
