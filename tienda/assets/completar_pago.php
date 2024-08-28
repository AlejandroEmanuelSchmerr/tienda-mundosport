<?php
session_start();
require 'funciones.php';
require 'vendor/autoload.php';

use tododeporte\Pedido;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pedido_id'])) {
        $pedido_id = $_POST['pedido_id'];
        $cliente_dni = $_SESSION['cliente_dni'];

        $pedido = new Pedido();
        $detalle_pedido = $pedido->mostrarDetallePorIdPedido($pedido_id);

        // Verifica si el pedido existe y está en estado 'pendiente'
        if ($detalle_pedido && isset($detalle_pedido[0]['estado']) && $detalle_pedido[0]['estado'] === 'pendiente') {
            // Calcula el total del pedido sumando los precios de todos los productos
            $total = 0;
            foreach ($detalle_pedido as $detalle) {
                $total += $detalle['precio'] * $detalle['cantidad'];
            }

            // Configura los parámetros para la solicitud de pago a PayPal
            $paypalUrl = 'https://www.paypal.com/cgi-bin/webscr'; // Para producción
            //$paypalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; // Para pruebas

            $params = [
                'cmd' => '_xclick',
                'business' => 'xordobaemanuel@hotmail.com',
                'item_name' => 'Compra en Tu Tienda',
                'amount' => $total,
                'currency_code' => 'USD',
                'return' => 'http://localhost/tienda/assets/paypal_success.php',
                'cancel_return' => 'http://localhost/tienda/assets/cancel.php',
                'notify_url' => 'http://localhost/tienda/assets/paypal_inp.php'
            ];

            // Redirige al usuario a PayPal con los parámetros de pago
            header('Location: ' . $paypalUrl . '?' . http_build_query($params));
            exit();
        } else {
            echo "El pedido no está en estado 'pendiente' o no existe.";
        }
    } else {
        echo "No se ha proporcionado ningún ID de pedido.";
    }
} else {
    echo "Método de solicitud no permitido.";
}
