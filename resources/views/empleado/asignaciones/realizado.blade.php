<!-- resources/views/empleado/asignaciones/realizadas.blade.php -->

<x-emple-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tareas Realizadas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if ($tareas->isEmpty())
                    <p class="text-gray-800 dark:text-gray-200">No hay tareas completadas.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($tareas as $tarea)
                            <div class="border border-gray-300 dark:border-gray-700 rounded-lg p-6 bg-white dark:bg-gray-800 mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $tarea->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-400">{{ $tarea->description }}</p>
                                <p class="mt-4 text-gray-800 dark:text-gray-200">Completado: Sí</p>
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
