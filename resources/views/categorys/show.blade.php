<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles de la Categoría') }}
        </h2>
        <div class="mt-4">
            <a href="{{ route('categorys.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Regresar') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div>
                        <p class="font-semibold text-gray-700 dark:text-gray-300">Categoria</p>
                        <p class="text-white-800 dark:text-gray-200">{{ $category->name }}</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
