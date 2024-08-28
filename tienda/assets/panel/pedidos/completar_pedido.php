
<?php
session_start();

if (!isset($_SESSION['usuario_info']) OR empty($_SESSION['usuario_info'])) {
    header('Location: ../index.php');
    exit();
}

require '../../vendor/autoload.php';

use tododeporte\Pedido;
use tododeporte\Pago;
use tododeporte\Venta;

$pedido_id = $_POST['pedido_id'];
$estado = $_POST['estado'];

$pedido = new Pedido();
$pago = new Pago();
$venta = new Venta($pedido->getConnection()); // Usar la conexión correcta

// Obtener la información del pedido
$info_pedido = $pedido->mostrarPorId($pedido_id);

// Verificar el estado del pedido y actuar en consecuencia
if ($estado === 'Entregado') {
    // Cambiar el estado del pedido a 'Entregado'
    if ($pedido->entregarPedido($pedido_id)) {
        // Registrar la venta
        $total = $info_pedido['total'];
        $cliente_dni = $info_pedido['cliente_dni'];
        $pedido_historico_id = $pedido_id; // Ahora estamos usando el ID del pedido histórico
        $venta->registrarVenta($pedido_historico_id, $cliente_dni, $total);

        // Procesar el pago (aquí podrías añadir la lógica de pago usando la clase Pago)
        // ...

        header('Location: ../pedidos/index.php');
        exit();
    } else {
        echo "Error al entregar el pedido.";
    }
} elseif ($estado === 'Anulado') {
    // Lógica para anular el pedido
    if ($pedido->anular($pedido_id)) {
        header('Location: ../pedidos/index.php');
        exit();
    } else {
        echo "Error al anular el pedido.";
    }
}
