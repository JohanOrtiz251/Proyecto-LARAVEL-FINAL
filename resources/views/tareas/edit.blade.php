<!-- resources/views/tareas/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="w-full flex justify-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Editar Tarea
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('tareas.update', $tarea->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="title">
                            Título
                        </label>
                        <input type="text" name="title" class="form-input w-full bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded" value="{{ $tarea->title }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="description">
                            Descripción
                        </label>
                        <textarea name="description" class="form-input w-full bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded">{{ $tarea->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="assigned_to">
                            Asignado a
                        </label>
                        <select name="assigned_to" class="form-select w-full bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded">
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ $tarea->assigned_to == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
