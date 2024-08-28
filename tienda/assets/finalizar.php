<?php
session_start();
require 'funciones.php';
require 'vendor/autoload.php'; 


if (!isset($_SESSION['cliente_dni'])) {
    header('Location: login.php'); 
    exit();
} else {
    
    $cliente = new tododeporte\ClienteRegistrado();
    $user = $cliente->obtenerClientePorDni($_SESSION['cliente_dni']);

    
    header('Location: completar_pedido.php');
    exit();
}



