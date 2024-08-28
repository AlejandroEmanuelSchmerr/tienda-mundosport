<?php
session_start();

// Aquí incluirás las librerías de PayPal o el SDK necesario
require 'vendor/autoload.php';

// Configura tu cuenta de PayPal (este es un ejemplo simplificado)
$clientId = 'AX0FrF_48g61hIpV3ZtgnR3sGjEC1O5oo1vZ1YiE2WI10zKDrkKp3tOdy8k8pzA_KNjIGHlvg9FNB369';
$clientSecret = 'EKfZ45fH5F2GxtO0_rLiIfwIER3nTypIGOfSn48JT2zatOyHCY66otsgtUO4Vvi_2icU8xWutxlD2bWh';
$paypalUrl = 'https://www.paypal.com/cgi-bin/webscr'; // Para producción
//$paypalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; // Para pruebas

// Si no hay productos en el carrito, redirige al usuario
if (empty($_SESSION['carrito'])) {
    header('Location: carrito.php');
    exit();
}

// Calcula el monto total
$total = calcularTotal();

// Configura los parámetros para la solicitud de pago
$params = [
    'cmd' => '_xclick',
    'business' => 'xordobaemanuel@hotmail.com',
    'item_name' => 'Compra en Tu Tienda',
    'amount' => $total,
    'currency_code' => 'USD',
    'return' => 'http://localhost/tienda/assets/paypal_success.php',
    'cancel_return' => 'http://localhost/tienda/assets/paypal_cancel.php',
    'notify_url' => 'http://localhost/tienda/assets/paypal_ipn.php'
];

// Redirige al usuario a PayPal
header('Location: ' . $paypalUrl . '?' . http_build_query($params));
exit();
