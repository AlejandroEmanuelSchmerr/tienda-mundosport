<?php
session_start();

require 'funciones.php';
require 'vendor/autoload.php';
require 'funciones.php';

// Calcula el monto total
$total = calcularTotal();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $cliente = new tododeporte\ClienteRegistrado();

        // Verificar si el usuario ya ha iniciado sesión
        if (isset($_SESSION['cliente_dni'])) {
            // Si el usuario está autenticado, obtenemos sus datos de la base de datos
            $cliente_dni = $_SESSION['cliente_dni'];
            $user = $cliente->obtenerClientePorDni($cliente_dni);
        } else {
            // Si no está autenticado, registramos un nuevo cliente
            $_params = array(
                'dni' => $_POST['dni'],
                'nombre' => $_POST['nombre'],
                'apellidos' => $_POST['apellidos'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'telefono' => $_POST['telefono'],
                'comentario' => $_POST['comentario']
            );
            
            // Registrar al nuevo cliente
            $cliente_dni = $_params['dni'];
            $cliente->registrar($_params);
        }

        // Registrar el pedido
        $pedido = new tododeporte\Pedido();
        $_params_pedido = array(
            'cliente_dni' => $cliente_dni, // Usamos el DNI del cliente autenticado o recién registrado
            'total' => calcularTotal(),
            'fecha' => date('Y-m-d'),
            'estado' => 'pendiente'
        );

        $pedido_id = $pedido->registrar($_params_pedido);

        // Registrar los detalles del pedido
        foreach ($_SESSION['carrito'] as $indice => $value) {
            $_params_detalle = array(
                'pedido_id' => $pedido_id,
                'producto_id' => $value['id'],
                'precio' => $value['precio'],
                'cantidad' => $value['cantidad'],
            );
            $pedido->registrarDetalle($_params_detalle);
        }

        // Vaciar el carrito de compras
        $_SESSION['carrito'] = array();

        // Redirigir a la página de agradecimiento
        header('Location: gracias.php');
        exit();
    } else {
        echo "El carrito está vacío.";
    }
} else {
    echo "Método de solicitud no permitido.";
}
