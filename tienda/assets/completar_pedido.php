<?php
session_start();

require 'funciones.php';
require 'vendor/autoload.php';
require 'funciones.php';


$total = calcularTotal();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $cliente = new tododeporte\ClienteRegistrado();

        if (isset($_SESSION['cliente_dni'])) {
          
            $cliente_dni = $_SESSION['cliente_dni'];
            $user = $cliente->obtenerClientePorDni($cliente_dni);
        } else {
            
            $_params = array(
                'dni' => $_POST['dni'],
                'nombre' => $_POST['nombre'],
                'apellidos' => $_POST['apellidos'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'telefono' => $_POST['telefono'],
                'comentario' => $_POST['comentario']
            );
            

            $cliente_dni = $_params['dni'];
            $cliente->registrar($_params);
        }

        $pedido = new tododeporte\Pedido();
        $_params_pedido = array(
            'cliente_dni' => $cliente_dni,
            'total' => calcularTotal(),
            'fecha' => date('Y-m-d'),
            'estado' => 'pendiente'
        );

        $pedido_id = $pedido->registrar($_params_pedido);

        foreach ($_SESSION['carrito'] as $indice => $value) {
            $_params_detalle = array(
                'pedido_id' => $pedido_id,
                'producto_id' => $value['id'],
                'precio' => $value['precio'],
                'cantidad' => $value['cantidad'],
            );
            $pedido->registrarDetalle($_params_detalle);
        }

        
        $_SESSION['carrito'] = array();

        
        header('Location: gracias.php');
        exit();
    } else {
        echo "El carrito está vacío.";
    }
} else {
    echo "Método de solicitud no permitido.";
}
