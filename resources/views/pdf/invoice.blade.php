<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura {{ $invoice['numero'] }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #2c3e50;
        }
        .cliente, .invoice-info {
            margin-bottom: 15px;
        }
        .cliente p, .invoice-info p {
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }
        th {
            background: #f5f5f5;
            font-weight: bold;
        }
        .summary {
            width: 40%;
            float: right;
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }
        .summary table {
            width: 100%;
            border: none;
        }
        .summary td {
            border: none;
            padding: 4px 0;
        }
        .total {
            font-weight: bold;
            font-size: 14px;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Factura</h1>
        <p>Número: {{ $invoice['numero'] }} | Fecha: {{ $invoice['fecha'] }}</p>
    </div>

    <div class="cliente">
        <h3>Cliente</h3>
        <p><strong>{{ $cliente['nombre'] }}</strong></p>
        <p>{{ $cliente['direccion'] }}</p>
        <p>{{ $cliente['email'] }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cant.</th>
                <th>Precio Unit.</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $p)
                <tr>
                    <td>{{ $p['nombre'] }}</td>
                    <td>{{ $p['cantidad'] }}</td>
                    <td>${{ number_format($p['precio'], 2) }}</td>
                    <td>${{ number_format($p['precio'] * $p['cantidad'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <table>
            <tr>
                <td>Subtotal:</td>
                <td>${{ number_format($invoice['subtotal'], 2) }}</td>
            </tr>
            <tr>
                <td>IVA (16%):</td>
                <td>${{ number_format($invoice['iva'], 2) }}</td>
            </tr>
            <tr class="total">
                <td>Total:</td>
                <td>${{ number_format($invoice['total'], 2) }}</td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>

    <div class="footer">
        {{-- <p>Gracias por su compra.</p> --}}
    </div>
</body>
</html>
