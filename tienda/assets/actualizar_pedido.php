<?php
session_start();
require 'vendor/autoload.php';
require 'funciones.php';

use tododeporte\Pedido;

// Verificar que el cliente esté autenticado
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
$pedidoDetalles = $pedido->mostrarDetallePorIdPedido($pedido_id); // Cambia esto si es necesario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['cantidad'] as $detalle_id => $nueva_cantidad) {
        // Asegurate de que la cantidad sea valida antes de actualizar
        $nueva_cantidad = intval($nueva_cantidad); // Asegurate de que sea un numero entero
        if ($nueva_cantidad > 0) {
            $pedido->actualizarCantidad($detalle_id, $nueva_cantidad);
        }
    }
    header('Location: pedidos.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Pedido</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="assets/css/actualizar_pedido.css">
</head>
<body>
    <h1>Modificar Cantidad del Pedido</h1>
    <form action="" method="post">
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pedidoDetalles)): ?>
                    <?php foreach ($pedidoDetalles as $detalle): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detalle['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($detalle['precio']); ?></td>
                        <td>
                            <input type="number" name="cantidad[<?php echo $detalle['id']; ?>]" value="<?php echo htmlspecialchars($detalle['cantidad']); ?>" min="1">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No hay detalles para este pedido.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <button type="submit">Guardar Cambios</button>
    </form>
    <a href="pedidos.php">Volver a la lista de pedidos</a>
</body>
</html>
