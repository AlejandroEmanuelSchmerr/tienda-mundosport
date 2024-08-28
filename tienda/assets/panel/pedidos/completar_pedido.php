
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
$venta = new Venta($pedido->getConnection()); 


$info_pedido = $pedido->mostrarPorId($pedido_id);


if ($estado === 'Entregado') {
    if ($pedido->entregarPedido($pedido_id)) {
        // Registrar la venta
        $total = $info_pedido['total'];
        $cliente_dni = $info_pedido['cliente_dni'];
        $pedido_historico_id = $pedido_id; 
        $venta->registrarVenta($pedido_historico_id, $cliente_dni, $total);

        

        header('Location: ../pedidos/index.php');
        exit();
    } else {
        echo "Error al entregar el pedido.";
    }
} elseif ($estado === 'Anulado') {
    
    if ($pedido->anular($pedido_id)) {
        header('Location: ../pedidos/index.php');
        exit();
    } else {
        echo "Error al anular el pedido.";
    }
}
