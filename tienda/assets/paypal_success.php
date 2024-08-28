<?php
session_start();
require 'funciones.php';
require 'vendor/autoload.php';
use tododeporte\Pedido;
use tododeporte\Venta;

// Verifica si el usuario está autenticado
if (!isset($_SESSION['cliente_dni'])) {
    header('Location: registro.php');
    exit();
}



$paymentStatus = $_GET['st'] ?? 'Failed'; 
$paymentAmount = $_GET['amt'] ?? 0;
$paymentCurrency = $_GET['cc'] ?? 'USD';
$transactionId = $_GET['tx'] ?? '';

// Verifica el pago en PayPal
if ($paymentStatus === 'Completed' && $paymentAmount == calcularTotal() && $paymentCurrency == 'USD') {
    $cliente_dni = $_SESSION['cliente_dni'];

    // Actualiza el estado del pedido a "entregado"
    $pedido = new Pedido();
    $pedido_id = $pedido->actualizarEstadoPorTransaccion($transactionId, 'entregado');

    // Registrar la transacción en la tabla de ventas
    $venta = new Venta($venta);
    $venta->registrar(array(
        'pedido_id' => $pedido_id,
        'metodo_pago' => 'PayPal',
        'transaction_id' => $transactionId
    ));

    // Redirigir a la página de agradecimiento
    header('Location: gracias.php');
    exit();
} else {
    header('Location: carrito.php');
    exit();
}

