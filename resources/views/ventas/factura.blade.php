<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles de la Factura') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between mb-6">
                        <div>
                            <p class="font-semibold text-white dark:text-gray-200">Número de Factura:</p>
                            <p class="text-white">{{ $orderDetail->order->id }}</p>
                        </div>
                        <div>
                            <p class="font-semibold text-white dark:text-gray-200">Fecha de Emisión:</p>
                            <p class="text-white">{{ $orderDetail->order->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-300 dark:border-gray-700 pt-6">
                        <div class="flex justify-between mb-4">
                            <div>
                                <p class="font-semibold text-white dark:text-gray-200">Cliente:</p>
                                <p class="text-white">Cédula: {{ $orderDetail->cedula }}</p>
                            </div>
                            <div>
                                <p class="font-semibold text-white dark:text-gray-200">Cantidad:</p>
                                <p class="text-white">{{ $orderDetail->cantidad }}</p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <p class="font-semibold text-white dark:text-gray-200">Producto:</p>
                            <p class="text-white">{{ $orderDetail->product->name }}</p>
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <p class="font-semibold text-white dark:text-gray-200">Precio Unitario:</p>
                                <p class="text-white">${{ $orderDetail->product->price }}</p>
                            </div>
                            <div>
                                <p class="font-semibold text-white dark:text-gray-200">Total:</p>
                                <p class="text-white">${{ $orderDetail->total }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-6 bg-white dark:bg-gray-800">
                    <a href="{{ route('ventas.descargar-factura', $orderDetail->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Descargar Factura (PDF)
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
