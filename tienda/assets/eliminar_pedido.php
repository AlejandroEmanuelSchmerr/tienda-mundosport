<?php
session_start();
require 'vendor/autoload.php';
require 'funciones.php';

use tododeporte\Pedido;

if (!isset($_SESSION['cliente_dni'])) {
    header('Location: login.php');
    exit();
}

$pedido_id = $_GET['pedido_id'] ?? null;
if (!$pedido_id) {
    header('Location: pedidos.php');
    exit();
}

$pedido = new Pedido();
if ($pedido->eliminar($pedido_id)) {
    header('Location: pedidos.php');
    exit();
} else {
    echo "No se pudo eliminar el pedido.";
}
