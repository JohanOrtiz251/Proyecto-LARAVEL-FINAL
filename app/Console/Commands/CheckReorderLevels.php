<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class CheckReorderLevels extends Command
{
    protected $signature = 'check:reorder-levels';
    protected $description = 'Check product reorder levels and send alerts if needed';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
{
    $products = Product::whereColumn('quantity', '<=', 'reorder_level')->get();

    // Variable para almacenar los detalles de todos los productos que necesitan reabastecimiento
    $messageBody = "Estimado Dueño,\n\n";
    $messageBody .= "Los siguientes productos han alcanzado o están por debajo del nivel de reorden:\n\n";

    foreach ($products as $product) {
        // Agregar detalles de cada producto al mensaje
        $messageBody .= "Producto: {$product->name}\n";
        $messageBody .= "Cantidad actual: {$product->quantity}\n";
        $messageBody .= "Nivel de reorden: {$product->reorder_level}\n\n";
    }

    // Verificar si hay productos para enviar correo
    if ($products->isNotEmpty()) {
        // Agregar firma y despedida al mensaje
        $messageBody .= "Por favor, considere reabastecer estos productos lo antes posible.\n\n";
        $messageBody .= "Saludos,\n";
        $messageBody .= "El equipo de Gestión de Inventario";

        // Enviar el correo con la lista de productos
        Mail::raw($messageBody, function($message) {
            $message->to('jesusalondon2016@gmail.com')
                    ->subject("Reabastecimiento necesario para productos")
                    ->from('vladimirjosetorrealba@gmail.com', 'Empresa');
        });

        // Registrar en el log que se envió el correo
        \Log::info("Correo enviado para productos con bajos niveles de stock");
    } else {
        // Si no hay productos para enviar correo, registrar en el log
        \Log::info("No hay productos con bajos niveles de stock para enviar correo");
    }

    $this->info('Reorder levels checked and alerts sent if needed.');
}


}
