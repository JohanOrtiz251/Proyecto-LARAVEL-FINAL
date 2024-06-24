<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                {{ __('Detalles de la Categoría') }}
            </h2>
            <a href="{{ route('categorys.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Regresar') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
                    <p class="font-semibold text-lg text-gray-900 dark:text-gray-100">Categoría:</p>
                    <p class="text-gray-800 dark:text-gray-300">{{ $category->name }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
