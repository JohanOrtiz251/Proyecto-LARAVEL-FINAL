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
                    <div>
                        <p class="font-semibold">Cantidad:</p>
                        <p>{{ $orderDetail->cantidad }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Total:</p>
                        <p>{{ $orderDetail->total }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Cédula:</p>
                        <p>{{ $orderDetail->cedula }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Producto:</p>
                        <p>{{ $orderDetail->product->name }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="font-semibold">Fecha de la Orden:</p>
                        <p>{{ $orderDetail->order->created_at }}</p>
                    </div>
                    <!-- Otros detalles que desees mostrar de la factura -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
