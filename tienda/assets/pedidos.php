<?php
session_start();
require 'funciones.php';
require 'vendor/autoload.php';

use tododeporte\Pedido;

// Verificar si el cliente está autenticado
if (!isset($_SESSION['cliente_dni'])) {
    header('Location: login.php');
    exit();
}

$cliente_dni = $_SESSION['cliente_dni'];

$pedido = new Pedido();
$pedidos = $pedido->mostrarPedidosPorClienteDni($cliente_dni);  // Utilizar el método adecuado para obtener pedidos por DNI

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Pedidos</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.png">
    <link rel="stylesheet" href="assets/css/pedido_clientes.css">
</head>
<body>
<?php include('header.php'); ?>
<br><br><br><br><br><br><br><br><br><br>
    <h1>Mis Pedidos</h1>
    <table>
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?php echo htmlspecialchars($pedido['id']); ?></td>
                <td><?php echo htmlspecialchars($pedido['total']); ?></td>
                <td><?php echo htmlspecialchars($pedido['fecha']); ?></td>
                <td>
                    <a href="ver_detalle_pedido.php?pedido_id=<?php echo htmlspecialchars($pedido['id']); ?>&cliente_dni=<?php echo htmlspecialchars($cliente_dni); ?>">Ver Detalle</a> |
                    <a href="actualizar_pedido.php?pedido_id=<?php echo htmlspecialchars($pedido['id']); ?>&cliente_dni=<?php echo htmlspecialchars($cliente_dni); ?>">Modificar</a> |
                    <a href="eliminar_pedido.php?pedido_id=<?php echo htmlspecialchars($pedido['id']); ?>&cliente_dni=<?php echo htmlspecialchars($cliente_dni); ?>" onclick="return confirm('¿Estás seguro de eliminar este pedido?');">Eliminar</a>
                    <form action="completar_pago.php" method="post" style="display:inline;">
                    <input type="hidden" name="pedido_id" value="<?php echo htmlspecialchars($pedido['id']); ?>">
                    <button type="submit" class="btn btn-success">Pagar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="cerrar_sesion.php" class="btn btn-danger">Cerrar sesión</a>
    <?php include('includes/footer.html'); ?>
</body>
</html>
