<?php
session_start();
require 'funciones.php';
require 'vendor/autoload.php';

use tododeporte\Pedido;

// Verificar que se haya proporcionado un pedido_id
if (!isset($_GET['pedido_id'])) {
    header('Location: pedidos.php');
    exit();
}
$cliente_dni = $_SESSION['cliente_dni'];
$pedido_id = $_GET['pedido_id'];

$pedido = new Pedido();
$detalles = $pedido->mostrarDetallePorIdPedido($pedido_id);

if (!$detalles) {
    echo "No se encontraron detalles para este pedido.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del Pedido</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="assets/css/ver_pedido.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
</head>
<body>
    <h1>Detalles del Pedido</h1>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $detalle): ?>
            <tr>
                <td><?php echo htmlspecialchars($detalle['nombre']); ?></td>
                <td><?php echo htmlspecialchars($detalle['precio']); ?></td>
                <td><?php echo htmlspecialchars($detalle['cantidad']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="pedidos.php">Volver a Mis Pedidos</a>
</body>
</html>
