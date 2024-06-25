<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Dompdf\Dompdf;
use Dompdf\Options;

class FacturaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderDetail;

    public function __construct($orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }

    public function build()
    {
        $pdf = new Dompdf();
        $pdf->setOptions(new Options([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]));
        $pdf->loadHtml(view('ventas.facturapdf', ['orderDetail' => $this->orderDetail])->render());
        $pdf->render();
        $output = $pdf->output();
        $filePath = storage_path("app/public/factura-{$this->orderDetail->order_id}.pdf");
        file_put_contents($filePath, $output);

        return $this->view('emails.factura')
            ->subject('Su Factura de Compra')
            ->attach($filePath);
    }
}
