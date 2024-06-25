<x-emple-layout>
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
                            <p class="font-semibold">Número de Factura:</p>
                            <p>{{ $orderDetail->order->id }}</p>
                        </div>
                        <div>
                            <p class="font-semibold">Fecha de Emisión:</p>
                            <p>{{ $orderDetail->order->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-300 dark:border-gray-700 pt-6">
                        <div class="flex justify-between mb-4">
                            <div>
                                <p class="font-semibold">Cliente:</p>
                                <p>Cédula: {{ $orderDetail->cedula }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Cantidad:</p>
                                <p>{{ $orderDetail->cantidad }}</p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <p class="font-semibold">Producto:</p>
                            <p>{{ $orderDetail->product->name }}</p>
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <p class="font-semibold">Precio Unitario:</p>
                                <p>${{ $orderDetail->product->price }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Total:</p>
                                <p>${{ $orderDetail->total }}</p>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="mt-4">
                    <a href="{{ route('ventas.descargar-factura', $orderDetail->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Descargar Factura (PDF)
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>
</x-emple-layout>