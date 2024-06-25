<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Factura - {{ $orderDetail->order->id }}</title>
    <style>
        /* Estilos CSS para la factura */
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #333;
            font-weight: bold;
        }
        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                Factura
                            </td>
                            <td>
                                Fecha de Emisión: {{ $orderDetail->order->created_at->format('d/m/Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Cliente: {{ $orderDetail->cedula }}
                            </td>
                            <td>
                                Número de Factura: {{ $orderDetail->order->id }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Producto</td>
                <td>Cantidad</td>
            </tr>
            <tr class="item">
                <td>{{ $orderDetail->product->name }}</td>
                <td>{{ $orderDetail->cantidad }}</td>
            </tr>
            <tr class="total">
                <td></td>
                <td>
                    Total: ${{ $orderDetail->total }}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
