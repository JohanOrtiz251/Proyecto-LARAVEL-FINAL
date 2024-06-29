<!-- resources/views/tareas/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Crear Nueva Tarea') }}
            </h2>
            <a href="{{ route('tareas.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Volver a la lista de tareas') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('tareas.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-gray-800 dark:text-gray-200 text-sm font-bold mb-2">
                            {{ __('Título') }}
                        </label>
                        <input id="title" type="text" class="form-input w-full bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded py-2 px-4 focus:outline-none focus:border-blue-500" name="title" value="{{ old('title') }}" required autofocus>
                        @error('title')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-800 dark:text-gray-200 text-sm font-bold mb-2">
                            {{ __('Descripción') }}
                        </label>
                        <textarea id="description" class="form-textarea w-full bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded py-2 px-4 focus:outline-none focus:border-blue-500" name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="assigned_to" class="block text-gray-800 dark:text-gray-200 text-sm font-bold mb-2">
                            {{ __('Asignar a') }}
                        </label>
                        <select id="assigned_to" name="assigned_to" class="form-select bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-700 rounded py-2 px-4 focus:outline-none focus:border-blue-500">
                            <option value="" selected disabled>{{ __('Selecciona un empleado') }}</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('assigned_to') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_to')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Guardar Tarea') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
