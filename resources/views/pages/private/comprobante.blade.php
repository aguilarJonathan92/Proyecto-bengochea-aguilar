<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Pedido #{{ $order->id }}</title>
    <style>
        /* =====================================================
           SOUNDWAVE STORE — CSS exclusivo para comprobante PDF
           ===================================================== */

        :root {
            --color-uno:        #1A1A1A;
            --color-cuatro:     #1C1C24;
            --color-dos:        #d4a017;
            --color-cinco:      #E8C547;
            --color-seis:       #C0392B;
            --color-texto:      #FFFFFF;
            --color-muted:      #A0A0A0;
            --border-ui:        rgba(245, 245, 240, 0.12);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.5;
            background-color: #f4f4f0;
            color: #1A1A1A;
        }

        .invoice-box {
            width: 100%;
            background-color: #FFFFFF;
        }

        /* ── Barra de acento superior ── */
        .accent-bar {
            height: 4px;
            background-color: var(--color-dos);
        }

        /* ── Header ── */
        .header {
            background-color: var(--color-uno);
            padding: 20px 28px;
        }

        .header-table {
            width: 100%;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo-soundwave {
            font-size: 22px;
            font-weight: bold;
            color: var(--color-seis);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .logo-store {
            font-size: 22px;
            font-weight: bold;
            color: var(--color-texto);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .logo-sub {
            font-size: 9px;
            color: var(--color-muted);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 3px;
        }

        .header-badge {
            display: inline-block;
            background-color: var(--color-dos);
            color: var(--color-uno);
            font-size: 9px;
            font-weight: bold;
            padding: 4px 10px;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-meta {
            text-align: right;
            color: var(--color-muted);
            font-size: 10px;
            margin-top: 6px;
        }

        .header-meta strong {
            color: var(--color-dos);
        }

        /* ── Cuerpo ── */
        .body {
            padding: 24px 28px;
            padding-bottom: 80px;
        }

        /* ── Etiqueta de sección ── */
        .section-label {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--color-dos);
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        /* ── Grid de info (2 columnas) ── */
        .info-grid {
            width: 100%;
            margin-bottom: 22px;
            border-spacing: 0 0;
        }

        .info-grid td {
            vertical-align: top;
            width: 50%;
            padding-right: 12px;
        }

        .info-grid td:last-child {
            padding-right: 0;
            padding-left: 12px;
        }

        .info-block {
            background-color: #f8f8f5;
            border-radius: 6px;
            border: 1px solid #e8e8e4;
            padding: 12px 14px;
        }

        .info-row {
            width: 100%;
            margin-bottom: 5px;
        }

        .info-row td:first-child {
            color: var(--color-muted);
            font-size: 10px;
            width: 40%;
        }

        .info-row td:last-child {
            color: #1A1A1A;
            font-size: 10px;
            font-weight: bold;
            text-align: right;
        }

        /* ── Tabla de productos ── */
        .tabla-productos {
            width: 100%;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        .tabla-productos th {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--color-muted);
            border-bottom: 2px solid var(--color-dos);
            padding: 6px 8px;
            text-align: left;
        }

        .tabla-productos td {
            padding: 10px 8px;
            border-bottom: 1px solid #eeeeea;
            font-size: 11px;
            color: #1A1A1A;
        }

        .tabla-productos tr:last-child td {
            border-bottom: none;
        }

        .product-name {
            font-weight: bold;
            color: #1A1A1A;
        }

        .text-right {
            text-align: right !important;
        }

        /* ── Caja de total ── */
        .total-wrapper {
            width: 100%;
            margin-bottom: 24px;
        }

        .total-box {
            float: right;
            width: 38%;
            background-color: #f8f8f5;
            border: 1px solid #e8e8e4;
            border-radius: 6px;
            padding: 12px 14px;
        }

        .total-line {
            width: 100%;
            font-size: 10px;
            margin-bottom: 5px;
        }

        .total-line td:first-child {
            color: var(--color-muted);
        }

        .total-line td:last-child {
            text-align: right;
            font-weight: bold;
        }

        .total-final-row {
            border-top: 2px solid var(--color-dos);
            padding-top: 8px;
            margin-top: 6px;
        }

        .total-final-label {
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #555;
        }

        .total-final-amount {
            font-size: 18px;
            font-weight: bold;
            color: var(--color-dos);
            text-align: right;
        }

        .envio-gratis {
            color: #2e8b57;
            font-weight: bold;
        }

        /* ── Footer ── */
        .clearfix { clear: both; }

        .footer {
            background-color: var(--color-cuatro);
            padding: 14px 28px;
            margin-top: 40px;
            border-top: 2px solid var(--color-dos);
        }

        .footer-table {
            width: 100%;
        }

        .footer-table td {
            vertical-align: middle;
        }

        .footer-text {
            font-size: 10px;
            color: var(--color-muted);
        }

        .footer-status {
            text-align: right;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #2e8b57;
        }
    </style>
</head>
<body>
<div class="invoice-box">

    {{-- Barra dorada superior --}}
    <div class="accent-bar"></div>

    {{-- Header --}}
    <div class="header">
        <table class="header-table">
            <tr>
                <td>
                    <div>
                        <span class="logo-soundwave">SOUNDWAVE</span>
                        <span class="logo-store"> STORE</span>
                    </div>
                    <div class="logo-sub">Instrumentos Profesionales</div>
                </td>
                <td style="text-align: right;">
                    <div class="header-badge">Comprobante de Compra</div>
                    <div class="header-meta">
                        Pedido: <strong>#{{ $order->id }}</strong>
                        &nbsp;|&nbsp;
                        {{ $order->fecha_argentina }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- Cuerpo --}}
    <div class="body">

        {{-- Info Grid --}}
        <table class="info-grid">
            <tr>
                <td>
                    <div class="info-block">
                        <div class="section-label">Datos de Entrega</div>
                        <table style="width: 100%;">
                            <tr class="info-row">
                                <td>Destinatario</td>
                                <td>{{ $order->customer_name }} {{ $order->customer_lastname }}</td>
                            </tr>
                            <tr class="info-row">
                                <td>Dirección</td>
                                <td>{{ $order->delivery_street }}</td>
                            </tr>
                            <tr class="info-row">
                                <td>Cód. Postal</td>
                                <td>{{ $order->delivery_postal_code }}</td>
                            </tr>
                            <tr class="info-row">
                                <td>Email</td>
                                <td>{{ $order->customer_email }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td>
                    <div class="info-block">
                        <div class="section-label">Información de Pago</div>
                        <table style="width: 100%;">
                            <tr class="info-row">
                                <td>Método</td>
                                <td>{{ $order->payment_method_label }}</td>
                            </tr>
                            <tr class="info-row">
                                <td>Moneda</td>
                                <td>Pesos Argentinos ($)</td>
                            </tr>
                            <tr class="info-row">
                                <td>Envío</td>
                                <td class="envio-gratis">Gratis</td>
                            </tr>
                            <tr class="info-row">
                                <td>Estado</td>
                                <td>{{ strtoupper($order->status_label) }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        {{-- Tabla de productos --}}
        <div class="section-label">Detalle del Pedido</div>
        <table class="tabla-productos">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th class="text-right" style="width: 18%;">Precio Unit.</th>
                    <th class="text-right" style="width: 10%;">Cant.</th>
                    <th class="text-right" style="width: 20%;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td><span class="product-name">{{ $item->product->title ?? 'Producto' }}</span></td>
                        <td class="text-right">${{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-right">{{ $item->quantity }}</td>
                        <td class="text-right">${{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Total --}}
        <div class="total-wrapper">
            <div class="total-box">
                <table style="width: 100%;">
                    <tr class="total-line">
                        <td>Subtotal</td>
                        <td>${{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="total-line">
                        <td>Envío</td>
                        <td class="envio-gratis">Gratis</td>
                    </tr>
                </table>
                <div class="total-final-row">
                    <table style="width: 100%;">
                        <tr>
                            <td class="total-final-label">Total</td>
                            <td class="total-final-amount">${{ number_format($order->total, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

    </div>

    {{-- Footer --}}
    <div class="footer">
        <table class="footer-table">
            <tr>
                <td class="footer-text">
                    Gracias por elegirnos. Este documento sirve como constancia oficial de procesamiento de tu pedido.
                </td>
                <td class="footer-status">
                    {{ strtoupper($order->status_label) }}
                </td>
            </tr>
        </table>
    </div>

</div>
</body>
</html>