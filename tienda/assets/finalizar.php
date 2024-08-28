<?php
session_start();
require 'funciones.php';
require 'vendor/autoload.php'; 

// Verificar si el usuario está autenticado
if (!isset($_SESSION['cliente_dni'])) {
    header('Location: login.php'); // Redirigir a login si no está autenticado
    exit();
} else {
    // Obtener los datos del cliente desde la base de datos
    $cliente = new tododeporte\ClienteRegistrado();
    $user = $cliente->obtenerClientePorDni($_SESSION['cliente_dni']);

    // Si ya está autenticado, redirigir a la página de completar pedido
    header('Location: completar_pedido.php');
    exit();
}

// No pongas más HTML aquí, ya que no se ejecutará.

